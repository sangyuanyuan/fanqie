#此脚本用于把dz的会员数据一次性导入到cwps中
#注意，需要先自行清空cwps_user表中的所有记录，导入后，使用dz的管理员进行登录

TRUNCATE TABLE `cwps_user`;


#插入主要会员信息，如有需要请自行修改cwps中的目标表名(CWPS_USER), 和dz中的来源表名(cdb_members)，比如表名前缀不是默认的时候
#注意，如果Discuz和cwps数据库不是同一个，请修改cdb_members为discuz.cdb_members,也就是库名.表名
INSERT INTO `cwps_user` (UserID,UserName,NickName,Status,Password,Gender,GroupID,RegisterDate,Email,Birthday,PassQuestion,PassAnswer,SubGroupIDs,RoleID,SubRoleIDs) SELECT uid,username,username,1,password,gender,groupid,regdate,email,bday,'','','',2,'' FROM `cdb_members`;

  
#把不是dz管理员组1的会员组，全部改成cwps的一般会员组3
UPDATE `cwps_user` SET GroupID=3  WHERE GroupID != 1;

#把dz管理员组1的全部改成cwps的管理组2
UPDATE `cwps_user` SET GroupID=2  Where GroupID = 1;


#清空附加会员表
TRUNCATE TABLE `cwps_user_extra`;

#插入附加会员关联记录，如有需要请自行修改cwps中的目标表名(CWPS_USER)和(cwps_user_extra)
INSERT INTO `cwps_user_extra` (UserID)  SELECT UserID FROM `cwps_user`;