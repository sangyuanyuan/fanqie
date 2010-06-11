<?php
require_once 'common.php';

    if (!defined('PMA_MYSQL_INT_VERSION')) {
        $result = mysql_query('SELECT VERSION() AS version');
        if ($result != FALSE && @mysql_num_rows($result) > 0) {
            $row   = mysql_fetch_row($result);
            $match = explode('.', $row[0]);
            mysql_free_result($result);
        }
        if (!isset($row)) {
            define('PMA_MYSQL_INT_VERSION', 32332);
            define('PMA_MYSQL_STR_VERSION', '3.23.32');
        } else{
            define('PMA_MYSQL_INT_VERSION', (int)sprintf('%d%02d%02d', $match[0], $match[1], intval($match[2])));
            define('PMA_MYSQL_STR_VERSION', $row[0]);
            unset($result, $row, $match);
        }
    }

    function PMA_backquote($a_name, $do_it = TRUE)
    {
        if ($do_it
            && !empty($a_name) && $a_name != '*') {

            if (is_array($a_name)) {
                 $result = array();
                 foreach ($a_name AS $key => $val) {
                     $result[$key] = '`' . $val . '`';
                 }
                 return $result;
            } else {
                return '`' . $a_name . '`';
            }
        } else {
            return $a_name;
        }
    } // end of the 'PMA_backquote()' function


    function PMA_getTableDef($db_name, $table, $crlf, $drop)
    {
        global $db;
        global $use_backquotes;
         $schema_create = '';
        if (!empty($drop)) {
            $schema_create .= 'DROP TABLE IF EXISTS ' . PMA_backquote($table) . ';' . $crlf;
        }

        // Steve Alberty's patch for complete table dump,
        // modified by Lem9 to allow older MySQL versions to continue to work
        if (PMA_MYSQL_INT_VERSION >= 32321) {
            // Whether to quote table and fields names or not
            if ($use_backquotes) {
                mysql_query('SET SQL_QUOTE_SHOW_CREATE = 1');
            } else {
                mysql_query('SET SQL_QUOTE_SHOW_CREATE = 0');
            }
			
            $result = mysql_query('SHOW CREATE TABLE ' . PMA_backquote($db_name) . '.' . PMA_backquote($table));
            if ($result != FALSE && mysql_num_rows($result) > 0) {
                $tmpres        = mysql_fetch_array($result);
                // Fix for case problems with winwin, thanks to
                // Pawe?Szczepa駍ki <pauluz at users.sourceforge.net>
                $pos           = strpos($tmpres[1], ' (');

                // Fix a problem with older versions of mysql
                // Find the first opening parenthesys, i.e. that after the name
                // of the table
                $pos2          = strpos($tmpres[1], '(');
                // Old mysql did not insert a space after table name
                // in query "show create table ..."!
                if ($pos2 != $pos + 1)
                {
                    // This is the real position of the first character after
                    // the name of the table
                    $pos = $pos2;
                    // Old mysql did not even put newlines and indentation...
                    $tmpres[1] = str_replace(",", ",\n     ", $tmpres[1]);
                }

                $tmpres[1]     = substr($tmpres[1], 0, 13)
                               . (($use_backquotes) ? PMA_backquote($tmpres[0]) : $tmpres[0])
                               . substr($tmpres[1], $pos);
				$tmpres[1] = $tmpres[1].";\n";
                $schema_create .= str_replace("\n", $crlf, $tmpres[1]);
            }
 				mysql_free_result($result);
           
            return $schema_create;
        } // end if MySQL >= 3.23.21

        // For MySQL < 3.23.20
        $schema_create .= 'CREATE TABLE ' . PMA_backquote($table) . ' (' . $crlf;

        $local_query   = 'SHOW FIELDS FROM ' . PMA_backquote($table) . ' FROM ' . PMA_backquote($db_name);
        $result        = mysql_query($local_query) ;
        while ($row = mysql_fetch_array($result)) {
            $schema_create     .= '   ' . PMA_backquote($row['Field'], $use_backquotes) . ' ' . $row['Type'];
            if (isset($row['Default']) && $row['Default'] != '') {
                $schema_create .= ' DEFAULT \'' . mysql_real_escape_string($row['Default']) . '\'';
            }
            if ($row['Null'] != 'YES') {
                $schema_create .= ' NOT NULL';
            }
            if ($row['Extra'] != '') {
                $schema_create .= ' ' . $row['Extra'];
            }
            $schema_create     .= ',' . $crlf;
        } // end while
        mysql_free_result($result);
        $schema_create         = ereg_replace(',' . $crlf . '$', '', $schema_create);

        $local_query = 'SHOW KEYS FROM ' . PMA_backquote($table) . ' FROM ' . PMA_backquote($db_name);
        $result      = mysql_query($local_query) ;
        while ($row = mysql_fetch_array($result))
        {
            $kname    = $row['Key_name'];
            $comment  = (isset($row['Comment'])) ? $row['Comment'] : '';
            $sub_part = (isset($row['Sub_part'])) ? $row['Sub_part'] : '';

            if ($kname != 'PRIMARY' && $row['Non_unique'] == 0) {
                $kname = "UNIQUE|$kname";
            }
            if ($comment == 'FULLTEXT') {
                $kname = 'FULLTEXT|$kname';
            }
            if (!isset($index[$kname])) {
                $index[$kname] = array();
            }
            if ($sub_part > 1) {
                $index[$kname][] = PMA_backquote($row['Column_name'], $use_backquotes) . '(' . $sub_part . ')';
            } else {
                $index[$kname][] = PPMA_backquote($row['Column_name'], $use_backquotes);
            }
        } // end while
        mysql_free_result($result);

        while (list($x, $columns) = @each($index)) {
            $schema_create     .= ',' . $crlf;
            if ($x == 'PRIMARY') {
                $schema_create .= '   PRIMARY KEY (';
            } else if (substr($x, 0, 6) == 'UNIQUE') {
                $schema_create .= '   UNIQUE ' . substr($x, 7) . ' (';
            } else if (substr($x, 0, 8) == 'FULLTEXT') {
                $schema_create .= '   FULLTEXT ' . substr($x, 9) . ' (';
            } else {
                $schema_create .= '   KEY ' . $x . ' (';
            }
            $schema_create     .= implode($columns, ', ') . ')';
        } // end while

        $schema_create .= $crlf . ')';

        return $schema_create;
    } // end of the 'PMA_getTableDef()' function






if(!$sys->isAdmin()) {
	goback('access_deny_module_db');

}
require_once INCLUDE_PATH."admin/dbAdmin.class.php";

$adminDB=new adminDatabase;

switch($IN[o]) {
	case 'backup':
		if(!empty($IN['running'])) {
			$FileData = '';
			$FileSize = 0;
			//print_r($_SESSION['BackUp_TableSession']);
			if(!empty($_SESSION['BackUp_TableSession'])) {
				$flag = true;
				//print_r($_SESSION);exit;
				while($flag) {
					//$_SESSION[BackUp_FilePrefix]
					/*
						$_SESSION[BackUp_TableSession] = array(
							'name'=> $v,
							'Rows'=> $result['Rows'],
							'Avg_row_length'=> $result['Avg_row_length'],
						);				
					
					2*1024*1024
					*/
					//$_SESSION[BackUp_Index][]

					$MaxFileSize = empty($_SESSION['BackUp_MaxFileSize']) ? 1048576 : $_SESSION['BackUp_MaxFileSize']; //10M
					$CurrentTable = array_shift($_SESSION['BackUp_TableSession']);
					//print_r($_SESSION['BackUp_TableSession']);
					//
					if(($FileSize + ($CurrentTable['Rows']*$CurrentTable['Avg_row_length'])) <= $MaxFileSize) {
						$FileData .= $adminDB->dumptable($CurrentTable['name'],$CurrentTable['start'], $CurrentTable['Rows']);
						$FileSize = $FileSize + ($CurrentTable['Rows']*$CurrentTable['Avg_row_length']);
						if(empty($_SESSION['BackUp_TableSession'])) $flag = false;
					} else { //FileSize > 
						
						$ToGetRows = ceil(($MaxFileSize - $FileSize) / $CurrentTable['Avg_row_length']);
						$FileSize = $FileSize + ($ToGetRows*$CurrentTable['Avg_row_length']);
						$FileData .= $adminDB->dumptable($CurrentTable['name'], $CurrentTable['start'], $ToGetRows);
						$CurrentTable['Rows'] = $CurrentTable['Rows'] - $ToGetRows;
						$CurrentTable['start'] = $CurrentTable['start'] + $ToGetRows;
						array_unshift($_SESSION['BackUp_TableSession'], $CurrentTable);
						$flag = false;
					}
					 
					 
				}
				
				$backupFileName = $_SESSION[BackUp_FilePrefix].$_SESSION[BackUp_Count].".sql";
				$_SESSION[BackUp_Count]++;
				$_SESSION[BackUp_Index][] = $backupFileName;
				$fp = @fopen($SYS_ENV[backupPath].'/'.$backupFileName,'w');
				if ($fp) {
					flock($fp, LOCK_EX);
					fwrite($fp, $FileData );
					fclose($fp);
 				}
				
				showMsg(sprintf($_LANG_ADMIN['db_backup_running'], $backupFileName), $base_url."o=backup&running=1");


			} else {  //Backup finished
				$IndexData = "<Backup>\n";
				foreach($_SESSION[BackUp_Index] as $var) {
					$IndexData .= "<File>$var</File>\n";
				}

				$IndexData .= "</Backup>";


				$IndexFileName =  $_SESSION[BackUp_FilePrefix]."index.xml";
				$fp = @fopen($SYS_ENV[backupPath].'/'.$IndexFileName,'w');
				if ($fp) {
					flock($fp, LOCK_EX);
					fwrite($fp, $IndexData );
					fclose($fp);
 				}
				showMsg($_LANG_ADMIN['db_backup_finished'], $base_url);
		
			}




		} else {
			$_SESSION['BackUp_MaxFileSize'] = $IN['MaxFileSize']*1024*1024;
			//echo $IN['addDrop'];
			if($adminDB->backupInit($IN[tablename], $IN['addDrop']))
				showMsg($_LANG_ADMIN['db_backup_init_ok'], $base_url."o=backup&running=1");
			else
				showMsg($_LANG_ADMIN['db_backup_init_fail']);		
		}
 

		break;
	case 'optimize':
		if($adminDB->OptimizeTables($IN[tablename]))
			showMsg($_LANG_ADMIN['db_optimize_ok']);
		else
			showMsg($_LANG_ADMIN['db_optimize_fail']);


		break; 
	case 'restore':
		$TPL->assign('backIndexs', $adminDB->getBackupIndex());
		
		$TPL->display('admin_db_restore.html');
		break;
	case 'restore_submit':
		
		if($IN['running'] == 1) {
			if(!empty($_SESSION['RestoreBackupFiles'])) {
				$backFile = array_shift($_SESSION['RestoreBackupFiles']);
				$sql = getFile($SYS_ENV[backupPath].'/'.$backFile);
				plugin_runquery($sql);			
				showMsg(sprintf($_LANG_ADMIN['db_restore_running'], $backFile), $base_url."o=restore_submit&running=1");
			} else {
				showMsg($_LANG_ADMIN['db_restore_finished'], $base_url);
				
			}

		} else {
			$IndexContent = getFile($SYS_ENV[backupPath].'/'.$IN['RestoreIndex']);
			preg_match_all("/<File>(.*)<\/File>/isU", $IndexContent, $matches);

			$_SESSION['RestoreBackupFiles'] = $matches[1];
			//print_r($_SESSION['RestoreBackupFiles']);
			showMsg($_LANG_ADMIN['db_restore_init'], $base_url."o=restore_submit&running=1");
		
		}



		break;
	case 'query':
		$TPL->display('admin_db_query.html');
		break;
		break;
	case 'query_submit':
		if(!empty($IN[sql])) {
			if($result = plugin_runquery($IN[sql])) {
				if(preg_match("/select/isU",$IN[sql] )) {
					while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
						$theresult[] = $row;
					}
					$TPL->assign('result', $theresult);
				
				}

				$TPL->assign('query_result', $_LANG_ADMIN['db_query_ok']);
 			} else {
				$TPL->assign('query_result', $_LANG_ADMIN['db_query_fail']);
			}
		} else {
			$TPL->assign('query_result', $_LANG_ADMIN['db_query_null']);
		
		}

		$TPL->display('admin_db_query.html');

		break;
 
	default:

		$TPL->assign('tablelists',$adminDB->listTablesStatus());
		$TPL->assign('tablestats', $TableStats);
		$TPL->display('admin_db.html');
		

}


include MODULES_DIR.'footer.php' ;
?>
