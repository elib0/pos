DELETE FROM ospos_items
WHERE name='Gift Card' AND item_id!=-1;

INSERT INTO ospos_items
	(item_id, `name`)
SELECT * FROM (SELECT -1, 'Gift Card') AS tmp
WHERE NOT EXISTS (
    SELECT * FROM ospos_items WHERE item_id = -1
) LIMIT 1;

UPDATE ospos_items SET
	is_locked=1,
	is_service=1,
	deleted=0
WHERE name='Gift Card'
LIMIT 1;