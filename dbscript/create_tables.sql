
CREATE TABLE smg_role
(
	id                    VARCHAR(255) NULL,
	name                  VARCHAR(255) NULL,
	description           VARCHAR(255) NULL
)
;



ALTER TABLE smg_role
	ADD  PRIMARY KEY (id)
;



CREATE TABLE smg_role_item
(
	id                    INTEGER NULL,
	name                  VARCHAR(255) NULL,
	description           VARCHAR(255) NULL
)
;



ALTER TABLE smg_role_item
	ADD  PRIMARY KEY (id)
;



CREATE TABLE smg_role_item_user
(
	role_itme_id          INTEGER NULL,
	user_id               VARCHAR(255) NULL
)
;



CREATE TABLE smg_user
(
	name                  VARCHAR(255) NOT NULL,
	password              VARCHAR(255) NULL,
	register_type_id      VARCHAR(255) NULL,
	smg_real_id           INTEGER NULL,
	role_id               VARCHAR(255) NULL,
	id                    VARCHAR(255) NULL,
	nick_name             VARCHAR(255) NULL
)
;



ALTER TABLE smg_user
	ADD  PRIMARY KEY (id)
;



CREATE TABLE smg_user_real
(
	loginname             VARCHAR(255) NOT NULL,
	password              VARCHAR(255) NULL,
	nickname              VARCHAR(255) NULL,
	state                 INTEGER NULL,
	mobile                VARCHAR(255) NULL,
	email                 VARCHAR(255) NULL,
	birthday              DATETIME NULL,
	org_id                INTEGER NULL,
	gender                VARCHAR(255) NULL,
	createtime            DATETIME NULL,
	dept_id               INTEGER NULL,
	id                    INTEGER NOT NULL
)
;



ALTER TABLE smg_user_real
	ADD  PRIMARY KEY (id)
;



CREATE TABLE smg_user_register_type
(
	id                    VARCHAR(255) NULL,
	name                  VARCHAR(255) NULL,
	description           TEXT NULL
)
;



ALTER TABLE smg_user_register_type
	ADD  PRIMARY KEY (id)
;



ALTER TABLE smg_role_item_user
	ADD FOREIGN KEY R_4 (role_itme_id) REFERENCES smg_role_item(id)
;


ALTER TABLE smg_role_item_user
	ADD FOREIGN KEY R_5 (user_id) REFERENCES smg_user(id)
;



ALTER TABLE smg_user
	ADD FOREIGN KEY R_1 (register_type_id) REFERENCES smg_user_register_type(id)
;


ALTER TABLE smg_user
	ADD FOREIGN KEY R_2 (smg_real_id) REFERENCES smg_user_real(id)
;


ALTER TABLE smg_user
	ADD FOREIGN KEY R_3 (role_id) REFERENCES smg_role(id)
;


