
<?php
require_once 'db.php';

// 1. Іздеу және сүзгі мәндерін алу
$search = trim($_GET['search'] ?? '');
$service = trim($_GET['service'] ?? '');
$date = trim($_GET['date'] ?? '');

// 2. Сұрыптау бағытын тексеру
$sort = $_GET['sort'] ?? 'newest';

$allowedSorts = [
    'newest' => 'booking_date DESC, booking_time DESC',
    'oldest' => 'booking_date ASC, booking_time ASC',
    'name' => 'client_name ASC',
    'name_desc' => 'client_name DESC'
];

$orderBy = $allowedSorts[$sort] ?? $allowedSorts['newest'];

// 3. SQL сұранысын дайындау
$where = [];
$params = [];

if ($search !== '') {
    $where[] = "(client_name LIKE :search
                 OR phone LIKE :search
                 OR service LIKE :search)";
    $params['search'] = '%' . $search . '%';
}

if ($service !== '') {
    $where[] = "service = :service";
    $params['service'] = $service;
}

if ($date !== '') {
    $where[] = "booking_date = :date";
    $params['date'] = $date;
}

$whereSQL = '';

if (!empty($where)) {
    $whereSQL = 'WHERE ' . implode(' AND ', $where);
}

// 4. Барлық қызмет түрлерін алу
$serviceStmt = $pdo->query(
    "SELECT DISTINCT service FROM bookings
     WHERE service IS NOT NULL AND service != ''
     ORDER BY service ASC"
);

$services = $serviceStmt->fetchAll(PDO::FETCH_COLUMN);

// 5. Сәйкес жазылымдардың жалпы санын есептеу
$countSQL = "SELECT COUNT(*) FROM bookings $whereSQL";
$countStmt = $pdo->prepare($countSQL);
$countStmt->execute($params);

$totalBookings = (int)$countStmt->fetchColumn();

// 6. Пагинация
$perPage = 5;
$totalPages = max(1, (int)ceil($totalBookings / $perPage));

$page = max(1, (int)($_GET['page'] ?? 1));
$page = min($page, $totalPages);

$offset = ($page - 1) * $perPage;

// 7. Жазылымдарды алу
$sql = "SELECT * FROM bookings
        $whereSQL
        ORDER BY $orderBy
        LIMIT :limit OFFSET :offset";

$stmt = $pdo->prepare($sql);

foreach ($params as $key => $value) {
    $stmt->bindValue(':' . $key, $value, PDO::PARAM_STR);
}

$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

$stmt->execute();

$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 8. Бет сілтемелеріне арналған параметрлер
$queryParams = [
    'search' => $search,
    'service' => $service,
    'date' => $date,
    'sort' => $sort
];

function pageUrl($page, $params) {
    $params['page'] = $page;
    return '?' . http_build_query($params);
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Жазылымдарды басқару</title>
    <link rel="stylesheet" href="style.css">

    <style>
        .bookings-container {
            width: 95%;
            margin: 40px auto;
            overflow-x: auto;
        }

        .bookings-container h2 {
            text-align: center;
            color: #d45b83;
            margin-bottom: 25px;
        }

        .filter-form {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 25px;
            padding: 20px;
            background: #fff0f5;
            border-radius: 10px;
        }

        .filter-form input,
        .filter-form select {
            padding: 11px;
            border: 1px solid #e5a1b8;
            border-radius: 7px;
            font-size: 14px;
            background: white;
        }

        .filter-form input[type="text"] {
            width: 260px;
        }

        .filter-btn {
            padding: 11px 18px;
            background: #d45b83;
            color: white;
            border: none;
            border-radius: 7px;
            cursor: pointer;
        }

        .reset-btn {
            padding: 11px 18px;
            background: #888;
            color: white;
            text-decoration: none;
            border-radius: 7px;
        }

        .bookings-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        .bookings-table th,
        .bookings-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .bookings-table th {
            background: #d45b83;
            color: white;
        }

        .bookings-table tr:nth-child(even) {
            background: #fff0f5;
        }

        .action-btn {
            display: inline-block;
            padding: 8px 12px;
            margin: 3px;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 13px;
        }

        .edit-btn {
            background: #d45b83;
        }

        .delete-btn {
            background: #c0392b;
        }

        .add-btn {
            display: inline-block;
            padding: 12px 18px;
            background: #d45b83;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .result-info {
            margin: 15px 0;
            color: #555;
            text-align: center;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin: 25px 0;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            padding: 9px 14px;
            border-radius: 6px;
            text-decoration: none;
            background: #fff0f5;
            color: #d45b83;
            border: 1px solid #e5a1b8;
        }

        .pagination .active {
            background: #d45b83;
            color: white;
        }

        .pagination .disabled {
            opacity: 0.4;
        }

        @media (max-width: 700px) {
            .filter-form {
                flex-direction: column;
            }

            .filter-form input,
            .filter-form select {
                width: 100%;
                box-sizing: border-box;
            }
        }
    </style>
</head>

<body>

<div class="bookings-container">

    <h2>Клиенттердің жазылымдары</h2>

    <!-- Іздеу, сүзу және сұрыптау -->
    <form method="GET" action="manage_bookings.php"
          class="filter-form">

        <input
            type="text"
            name="search"
            placeholder="Аты, телефон немесе қызмет..."
            value="<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?>"
        >

        <select name="service">
            <option value="">Барлық қызметтер</option>

            <?php foreach ($services as $item): ?>
                <option
                    value="<?= htmlspecialchars($item, ENT_QUOTES, 'UTF-8') ?>"
                    <?= $service === $item ? 'selected' : '' ?>>
                    <?= htmlspecialchars($item, ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input
            type="date"
            name="date"
            value="<?= htmlspecialchars($date, ENT_QUOTES, 'UTF-8') ?>"
        >

        <select name="sort">
            <option value="newest" <?= $sort === 'newest' ? 'selected' : '' ?>>
                Жаңа күннен бастап
            </option>

            <option value="oldest" <?= $sort === 'oldest' ? 'selected' : '' ?>>
                Ескі күннен бастап
            </option>

            <option value="name" <?= $sort === 'name' ? 'selected' : '' ?>>
                Аты бойынша A-Z
            </option>

            <option value="name_desc" <?= $sort === 'name_desc' ? 'selected' : '' ?>>
                Аты бойынша Z-A
            </option>
        </select>

        <button type="submit" class="filter-btn">
            Қолдану
        </button>

        <a href="manage_bookings.php" class="reset-btn">
            Тазалау
        </a>

    </form>

    <a href="add_booking.php" class="add-btn">
        + Жаңа жазылым қосу
    </a>

    <p class="result-info">
        Табылған жазылымдар саны: <strong><?= $totalBookings ?></strong>
    </p>

    <table class="bookings-table">

        <tr>
            <th>ID</th>
            <th>Клиент аты</th>
            <th>Телефон</th>
            <th>Қызмет</th>
            <th>Күні</th>
            <th>Уақыты</th>
            <th>Түсініктеме</th>
            <th>Әрекеттер</th>
        </tr>

        <?php if (count($bookings) > 0): ?>

            <?php foreach ($bookings as $booking): ?>

                <tr>
                    <td><?= htmlspecialchars($booking['id']) ?></td>

                    <td><?= htmlspecialchars($booking['client_name']) ?></td>

                    <td><?= htmlspecialchars($booking['phone']) ?></td>

                    <td><?= htmlspecialchars($booking['service']) ?></td>

                    <td><?= htmlspecialchars($booking['booking_date']) ?></td>

                    <td><?= htmlspecialchars($booking['booking_time']) ?></td>

                    <td><?= htmlspecialchars($booking['comment'] ?? '') ?></td>

                    <td>
                        <a
                            href="edit_booking.php?id=<?= (int)$booking['id'] ?>"
                            class="action-btn edit-btn">
                            Өңдеу
                        </a>

                        <form
                            action="delete_booking.php"
                            method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('Бұл жазылымды өшіргіңіз келе ме?');">

                            <input
                                type="hidden"
                                name="id"
                                value="<?= (int)$booking['id'] ?>">

                            <button
                                type="submit"
                                class="action-btn delete-btn">
                                Өшіру
                            </button>
                        </form>
                    </td>
                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="8">
                    Сұраныс бойынша жазылымдар табылмады.
                </td>
            </tr>

        <?php endif; ?>

    </table>

    <!-- Пагинация -->
    <?php if ($totalPages > 1): ?>

        <div class="pagination">

            <?php if ($page > 1): ?>
                <a href="<?= htmlspecialchars(pageUrl($page - 1, $queryParams)) ?>">
                    « Алдыңғы
                </a>
            <?php else: ?>
                <span class="disabled">« Алдыңғы</span>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>

                <?php if ($i === $page): ?>
                    <span class="active"><?= $i ?></span>
                <?php else: ?>
                    <a href="<?= htmlspecialchars(pageUrl($i, $queryParams)) ?>">
                        <?= $i ?>
                    </a>
                <?php endif; ?>

            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="<?= htmlspecialchars(pageUrl($page + 1, $queryParams)) ?>">
                    Келесі »
                </a>
            <?php else: ?>
                <span class="disabled">Келесі »</span>
            <?php endif; ?>

        </div>

    <?php endif; ?>

</div>

</body>
</html>
