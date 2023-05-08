SELECT orders.*
FROM orders
INNER JOIN order_items ON orders.id = order_items.order_id
GROUP BY orders.id
HAVING COUNT(order_items.id) > 1;