<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sinh viên - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg: #f8fafc;
            --card-bg: rgba(255, 255, 255, 0.8);
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --success: #10b981;
            --danger: #ef4444;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f0f4ff 0%, #f8fafc 100%);
            color: var(--text-main);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 2rem;
            font-weight: 600;
            color: var(--primary);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        }

        .card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            gap: 20px;
        }

        .search-box {
            position: relative;
            flex: 1;
        }

        .search-box input {
            width: 100%;
            padding: 12px 20px;
            border-radius: 12px;
            border: 1px solid var(--border);
            outline: none;
            transition: all 0.3s;
            font-size: 0.95rem;
        }

        .search-box input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        th {
            text-align: left;
            padding: 16px;
            color: var(--text-muted);
            font-weight: 600;
            border-bottom: 2px solid var(--border);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid var(--border);
            font-size: 1rem;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: rgba(79, 70, 229, 0.02);
        }

        .actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .btn-icon {
            padding: 8px;
            border-radius: 8px;
            color: var(--text-muted);
            transition: all 0.2s;
            display: flex;
            align-items: center;
        }

        .btn-edit:hover {
            color: var(--primary);
            background: rgba(79, 70, 229, 0.1);
        }

        .btn-delete:hover {
            color: var(--danger);
            background: rgba(239, 68, 68, 0.1);
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 20px;
        }

        .page-link {
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid var(--border);
            text-decoration: none;
            color: var(--text-main);
            transition: all 0.2s;
        }

        .page-link.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .page-link:hover:not(.active) {
            background: var(--border);
        }

        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            animation: slideIn 0.3s ease-out;
        }

        .alert-success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        @keyframes slideIn {
            from { transform: translateY(-10px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Hệ thống Quản lý Sinh viên</h1>
            <a href="index.php?action=add" class="btn btn-primary">
                + Thêm sinh viên
            </a>
        </div>

        <?php if(isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?php 
                    if($_GET['success'] == 'add') echo "Đã thêm sinh viên thành công!";
                    if($_GET['success'] == 'edit') echo "Đã cập nhật thông tin thành công!";
                    if($_GET['success'] == 'delete') echo "Đã xóa sinh viên thành công!";
                ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="toolbar">
                <form action="index.php" method="GET" class="search-box">
                    <input type="hidden" name="action" value="list">
                    <input type="text" name="search" placeholder="Tìm kiếm sinh viên theo tên..." value="<?= htmlspecialchars($search) ?>">
                </form>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Ngành học</th>
                        <th style="text-align: right;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($students)): ?>
                        <tr>
                            <td colspan="4" style="text-align: center; color: var(--text-muted); padding: 40px;">
                                Không tìm thấy sinh viên nào.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($students as $st): ?>
                        <tr>
                            <td style="font-weight: 600; color: var(--text-muted);">#<?= $st["id"] ?></td>
                            <td style="font-weight: 500;"><?= htmlspecialchars($st["name"]) ?></td>
                            <td>
                                <span style="background: #eef2ff; color: #4338ca; padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">
                                    <?= htmlspecialchars($st["major"]) ?>
                                </span>
                            </td>
                            <td align="right">
                                <div class="actions">
                                    <a href="index.php?action=edit&id=<?= $st['id'] ?>" class="btn-icon btn-edit" title="Sửa">
                                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </a>
                                    <a href="index.php?action=delete&id=<?= $st['id'] ?>" class="btn-icon btn-delete" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')">
                                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>

            <?php if ($total_pages > 1): ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="index.php?action=list&page=<?= $i ?>&search=<?= urlencode($search) ?>" 
                       class="page-link <?= $page == $i ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
