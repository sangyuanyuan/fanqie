INSERT INTO {$table_header}sys VALUES ('','EnableWaterMark','0');
INSERT INTO {$table_header}sys VALUES ('','WaterMarkImgPath', '../html/WaterMark.gif');
INSERT INTO {$table_header}sys VALUES ('','WaterMarkPosition', '1');
ALTER TABLE {$table_header}content_index ADD COLUMN `TableID` int(10) NOT NULL DEFAULT 0;

