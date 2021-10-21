**MySQL的分层**

链接层 –> 处理层 –> 引擎层 –> 存储层

**SQL执行加载顺序**

```mysql
# 书写的SQL
SELECT DISTINCT
	<select_list>
FROM
	<left_table> <join_type>
JOIN <right_table> ON <join_condition>
WHERE
	<where_condition>
GROUP BY
	<group_by_list>
HAVING
	<having_condition>
ORDER BY
	<order_by_condition>
LIMIT
	<limit_number>
	
# 机读SQL的执行顺序
FROM <left_table>
ON <join_condition>
<join_type> JOIN <right_table> 
WHERE <where_condition>
GROUP BY <group_by_list>
HAVING <having_condition>
SELECT
DISTINCT <select_list>
ORDER BY <order_by_condition>
LIMIT <limit_number>

```

**七种JION理论**

```mysql
# A和B相交，取A的全部
SELECT <select_list> FROM TableA A LEFT JOIN TableB B ON A.key = B.Key
# A和B相交，取B的全部
SELECT <select_list> FROM TableA A RIGHT JOIN TableB B ON A.key = B.Key
# A和B相交，取相交部分
SELECT <select_list> FROM TableA A INNER JOIN TableB B ON A.key = B.Key
# A和B相交，取A内排除B的部分
SELECT <select_list> FROM TableA A LEFT JOIN TableB B ON A.key = B.Key WHERE B.key IS NULL
# A和B相交，取B内排除A的部分
SELECT <select_list> FROM TableA A RIGHT JOIN TableB B ON A.key = B.Key WHERE A.key IS NULL
# A和B相交，取两者的并集（mysql不支持FULL OUTER）
SELECT <select_list> FROM TableA A FULL OUTER JOIN TableB B ON A.key = B.Key WHERE B.key IS NULL
# 使用union来实现(全A+全B 后union去重) FULL OUTER
SELECT <select_list> FROM TableA A LEFT JOIN TableB B ON A.key = B.Key
union
SELECT <select_list> FROM TableA A RIGHT JOIN TableB B ON A.key = B.Key


# A和B相交，取两都并集中排除交集的部分（mysql不支持FULL OUTER）
SELECT <select_list> FROM TableA A FULL OUTER JOIN TableB B ON A.key = B.Key WHERE A.key IS NULL OR B.key IS NULL
# 使用union来实现(独A+独B 后union去重) FULL OUTER
SELECT <select_list> FROM TableA A LEFT JOIN TableB B ON A.key = B.Key WHERE B.key IS NULL
union
SELECT <select_list> FROM TableA A RIGHT JOIN TableB B ON A.key = B.Key WHERE A.key IS NULL

```

