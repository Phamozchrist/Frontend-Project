<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .search-bar {
  display: flex;
  align-items: center;
  background: #fff;
  border: 2px solid #ddd;
  border-radius: 40px;
  overflow: hidden;
  width: 400px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.search-category {
  border: none;
  padding: 10px;
  background: #f8f8f8;
  font-size: 14px;
  outline: none;
  cursor: pointer;
}

.search-input {
  flex: 1;
  border: none;
  padding: 12px 15px;
  font-size: 16px;
  outline: none;
}

.search-btn {
  background: #007bff;
  color: #fff;
  border: none;
  padding: 12px 20px;
  cursor: pointer;
  font-size: 16px;
  transition: 0.3s;
}

.search-btn:hover {
  background: #0056b3;
}

    </style>
</head>
<body>
    <div class="search-bar">
        <select class="search-category">
            <option value="all">All</option>
            <option value="products">Products</option>
            <option value="users">Users</option>
            <option value="orders">Orders</option>
        </select>
        <input type="search" placeholder="Search..." class="search-input">
        <button class="search-btn">🔍</button>
    </div>

</body>
</html>