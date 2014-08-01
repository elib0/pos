<?php
@header('Content-Type:text/html;charset=ISO-8859-1');
/*
	+-------------------------------------------------+
	|                                                 |
	|   Developed By:Websarrollo.com & Maoghost.com   |
	|   Copy Rights	:Tagamation, LLc                  |
	|   Date        :02/22/2011                       |
	|                                                 |
	+-------------------------------------------------+
*/

#Limpiar caracteres incompatibles con mysql
function cls_string($mensaje){
	/*$mensaje=str_replace(array("'","\\","\"","'","ÃƒÂ¯Ã‚Â¿Ã‚Â½","ÃƒÂ¯Ã‚Â¿Ã‚Â½","\'"),"",$mensaje);
	$mensaje=$mensaje;/**/
	return $mensaje;
}

#limpiar caracteres incompatibles con javascript
function js_string($mensaje,$comillas=0){
	$mensaje=str_replace(chr(13),' ',str_replace(chr(10),' ',$mensaje));
	if($comillas==1) $mensaje=str_replace("'","\'",$mensaje);
	if($comillas==2) $mensaje=str_replace('"','\"',$mensaje);
	return $mensaje;
}
function html_string($mensaje){
	$mensaje=str_minify($mensaje);
	$mensaje=str_replace("'",'&#39;',$mensaje);
	$mensaje=str_replace('"','&quot;',$mensaje);
	return $mensaje;
}

#minimizar espacios en blanco y saltos de linea en una cadena para reducir datos de envio
function str_minify($str){
	if(is_string($str)){
		$str=preg_replace('/\\s+/',' ',$str);
		$str=preg_replace('/\\s*([\(\)\{\};])\\s*/','$1',$str);
		return $str;
	}elseif(is_array($str)){
		foreach($str as $key=>$value)
			$str[$key]=str_minify($value);
	}else{
		return $str;
	}
}

#Evitar Inyecciones SQL
function quitar_inyect(){
	$filtro=array(
		'Content-Type:',
		'MIME-Version:',//evita email injection
		'Content-Transfer-Encoding:',
		'Return-path:',
		'Subject:',
		'From:',
		'Envelope-to:',
		'To:',
		'bcc:',
		'cc:',
		'UNION',//evita sql injection
		'DELETE',
		'DROP',
		'SELECT',
		'INSERT',
		'UPDATE',
		'CRERATE',
		'TRUNCATE',
		'ALTER',
		'INTO',
		'DISTINCT',
		'GROUP BY',
		'WHERE',
		'RENAME',
		'DEFINE',
		'UNDEFINE',
		'PROMPT',
		'ACCEPT',
		'VIEW',
		'COUNT',
		'HAVING',
		'W W W'
	);
	$_REQUEST=array();
	foreach($_GET as $k=>$v){
		if (!is_array($v)){
			foreach ($filtro as $index){
				$v=str_replace(trim($index),'',$v);
			}
			$_GET[$k]=$v;
			$_REQUEST[$k]=$v;
		}
	}
	foreach($_POST as $k=>$v){
		if (!is_array($v)){
			foreach ($filtro as $index){
				$v=str_replace(trim($index),'',$v);
			}
			$_POST[$k]=$v;
			$_REQUEST[$k]=$v;
		}
	}
	return true;
}

function jsonp($res,$printGlobals=true){
	if($printGlobals&&is_array($res)&&$debug!=''){
		$d=array();
		$d['cookies']=$_COOKIE;
		$d['server']=$_SERVER;
		$d['sesion']=$_SESSION;
		$d['POST']=$_POST;
		$d['GET']=$_GET;
		$headers=apache_request_headers();
		$d['ismobile']=($_POST['CROSSDOMAIN']||$headers['SOURCEFORMAT']=='mobile');
		$res['_DEBUG_']=$d;
	}
	$txt=json_encode($res);
	if(isset($_GET['callback'])) $txt=$_GET['callback']."($txt)";
	return $txt;
}

#Formatear las fechas,de mysql a html - de html a mysql
function formatoFecha($fecha){
	if(strpos($fecha,'-')){
		$fecha=explode('[-]',$fecha);
		$fecha[2]=explode('[ ]',$fecha[2]);
		$fecha[2]=$fecha[2][0];
		return $fecha[2].'/'.$fecha[1].'/'.$fecha[0];
	}elseif(strpos($fecha,'/')){
		$fecha=explode('[/]',$fecha);
		return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
	}
	return false;
}

#Imprimir vectores
function _imprimir($array='',$die=false){
	if($array=='') $array=$_REQUEST;
	echo '<div data-role="page" style="background:#fff;"><pre>';print_r($array);echo '</pre></div>';
	if($die) die();
}

#Formato Numerico
function formato($numero){
	return number_format($numero,2,',','.');//adrian
}

#Quita formato numerico
function sinFormato($number){
	return str_replace(',','.',str_replace('.','',$number));
}

#devuelve un campo de la bd
function campo($tabla,$campo,$criterio,$pos,$and=''){
	$array=$GLOBALS['cn']->queryRow('SELECT '.$pos.' FROM '.$tabla.' WHERE '.$campo.'="'.$criterio.'" '.$and);
	return $array[$pos];
}
function get_campo($id,$tabla,$comp='1'){
	$array=$GLOBALS['cn']->queryRow('SELECT '.$id.' FROM '.$tabla.' WHERE '.$comp);
	return $array[$id];
}

#verifica existencia de un registro en la bd
function existe($tabla,$campo,$where){
	$query=$GLOBALS['cn']->query('SELECT '.$campo.' FROM '.$tabla.' '.$where);
	return (mysql_num_rows($query)>0)?true:false;
}

#borrar de la bd
function delete($tabla,$campo,$criterio){
	return $GLOBALS['cn']->query('DELETE FROM '.$tabla.' WHERE '.$campo.'="'.$criterio.'"');
}

#formatear cadenas
function formatoCadena($cadena,$op=1){
	switch($op){
		case 1:return ucwords($cadena);break;#Pone en mayusculas el primer caracter de cada palabra de una cadena
		case 2:return ucfirst($cadena);break;#Pasar a mayusculas el primer caracter de una cadena
		case 3:return strtolower($cadena);break;#Pasa a minusculas una cadena
		case 4:return strtoupper($cadena);break;#Pasa a mayusculas una cadena
		case 5:return str_replace(' ','',strtolower($cadena));break;#Pasa a mayusculas una cadena
	}
}

#devueleve el numero de registros de una consulta sql
function numRecord($tabla,$where){
	$query=$GLOBALS['cn']->query('SELECT id FROM '.$tabla.' '.$where);
	return mysql_num_rows($query);
}

#suma registros en sql
function sumRecord($campo,$tabla,$where){
	$query=$GLOBALS['cn']->query('SELECT SUM('.$campo.') AS suma FROM '.$tabla.' '.$where);
	$array=mysql_fetch_assoc($query);
	return $array['suma'];
}

#semilla
function make_seed(){
	list($usec,$sec)=explode(' ',microtime());
	return (float) $sec+((float) $usec*100000);
}


#numero referencia
function refereeNumber($cad){
	$numero=substr(md5($cad),0,9);

	if (existe('users','referee_number',' WHERE referee_number LIKE "'.$numero.'"')){
		refereeNumber($cad.srand(make_seed()));
	}else{
		return $numero;
	}
}

#calculo de la edad
function edad($fecha,$char){
	list($Y,$m,$d)=explode($char,$fecha);
	return(date('md')<$m.$d?date('Y')-$Y-1:date('Y')-$Y);
}

function redirect($url,$html=true){
	if ($html)
		echo '<meta HTTP-EQUIV="REFRESH" content="0;url='.$url.'">';
	else
		echo '<div data-role="page"><script type="text/javascript">$.mobile.changePage("'.$url.'");</script></div>';
}

function mensajes($content,$titulo,$url='',$actions='',$mobile='',$id='#messages',$ancho=300,$largo=200){
	if($mobile!=1){
		echo '
		<script type="text/javascript">
			$(document).ready(function(){
				$("'.$id.'").dialog({
					title:"'.$titulo.'",
					resizable:false,
					width:'.$ancho.',
					height:'.$largo.',
					modal:true,
					show:"fade",
					hide:"fade",
					buttons:{
						'.JS_OK.':function(){
							$(this).dialog("close");
						}
					},
					close:function(){
						';
		if ($actions!=''){
			echo $actions;
		}else{
			echo ($url!=''?'':'//').'redirect("'.$url.'");';
		}
		echo '
					},
					open:function(){
						$("'.$id.'").html("'.$content.'");
					}//insert html
				});
			});
		</script>';
	}else{
		echo '
		<div data-role="page">
			<div data-role="header" data-nobackbtn="true" data-theme="d" >
			<a data-theme="d" href="#" data-rel="back" style="display:none"></a>
				<h1>'.$titulo.'</h1>
			</div><!--/header-->
			<div data-role="content">
				'.$content.'
				<a href="#" data-role="button" onclick="'.($actions!=''?$actions:($url!=''?(strpos(' '.$url,'Android')?$url:"location='".$url."'"):'')).'">Ok</a>
			</div><!--/content-->
			<div data-role="footer" data-theme="d" data-position="fixed">
				<h4>Tagbum &copy;</h4>
			</div>
		</div>';
		//die();
	}
}

function isFriend($id_friend,$id_user=''){
	if($id_user=='') $id_user=$_SESSION['ws-tags']['ws-user']['id'];
	$id_user=intToMd5($id_user);
	$id_friend=intToMd5($id_friend);
//	$query=$GLOBALS['cn']->query('
//		SELECT u1.id_friend
//		FROM users_links u1
//		JOIN users_links u2 ON u1.id_user=u2.id_friend AND u1.id_friend=u2.id_user
//		WHERE	md5(u1.id_user)="'.$id_friend.'" AND
//				md5(u1.id_friend)="'.$id_user.'"
//	');
	$query=$GLOBALS['cn']->query('
		SELECT id_friend
		FROM users_links
		WHERE	md5(id_user)="'.$id_user.'" AND
				md5(id_friend)="'.$id_friend.'" AND
				is_friend=1
	');
	return (mysql_num_rows($query)==0)?false:true;
}

function isFallowing($id_user,$id_friend){
	if($id_user=='') $id_user=$_SESSION['ws-tags']['ws-user']['id'];
	$id_user=intToMd5($id_user);
	$id_friend=intToMd5($id_friend);
//	$query=$GLOBALS['cn']->query('
//		SELECT id_friend
//		FROM users_links
//		WHERE md5(id_user)="'.$id_user.'" AND md5(id_friend)="'.$id_friend.'"
//	');
	$query=$GLOBALS['cn']->query('
		SELECT id_friend
		FROM users_links
		WHERE	md5(id_user)="'.$id_user.'" AND
				md5(id_friend)="'.$id_friend.'" AND
				is_friend=0
	');
	return (mysql_num_rows($query)==0)?false:true;
}

function dropViews($views){
	foreach($views as $view){
		$GLOBALS['cn']->query('DROP VIEW IF EXISTS '.$view);
	}
}

function view_friends($id='',$like='',$notIn='',$limit='0,2000'){
	$user=($id=='')?md5($_SESSION['ws-tags']['ws-user']['id']):md5($id);
	dropViews(array('view_friends'));

	//los que el usuario sigue
	$GLOBALS['cn']->query('
		CREATE VIEW view_friends AS
		SELECT DISTINCT
			l.id_user,
			l.id_friend,
			u.screen_name,
			CONCAT(u.name," ",u.last_name) AS name_user,
			u.profile_image_url AS photo_friend,
			u.email,
			u.home_phone,
			u.mobile_phone,
			u.followers_count,
			u.friends_count,
			u.work_phone,
			(SELECT c.name FROM countries c WHERE c.id=u.country) AS country,
			md5(CONCAT(u.id,"_",u.email,"_",u.id)) AS code_friend
		FROM users u JOIN users_links l ON u.id=l.id_friend
		WHERE md5(l.id_user)="'.$user.'" AND is_friend = 1
	');

	//amigos
	if($like!='') $like='AND f.name_user LIKE "%'.$like.'%"';

	$friends=$GLOBALS['cn']->query('
		SELECT	f.id_friend,
				f.name_user,
				f.photo_friend,
				f.code_friend,
				f.email,
				f.home_phone,
				f.screen_name,
				f.mobile_phone,
				f.followers_count,
				f.friends_count,
				f.work_phone,
				f.country
		FROM view_friends f JOIN users_links u ON f.id_friend=u.id_user
		WHERE md5(u.id_friend)="'.$user.'" '.$like.' '.$notIn.'
		ORDER BY f.name_user
		LIMIT '.$limit.';'
		);

	return $friends;
}

function friendsHelp($datos,$value=false){
//function friendsHelp($value="u.email"){
	$user=md5($_SESSION['ws-tags']['ws-user'][id]);
	dropViews(array('view_friends'));
	$value=$value?"u.id":"u.email";
	//los que el usuario sigue detail as 'key',id as 'value'
	$GLOBALS['cn']->query('
		CREATE VIEW view_friends AS
		SELECT DISTINCT
			CONCAT(u.name," ",u.last_name) AS "key",
			'.$value.' AS "value",
			l.id_friend as id_friend
		FROM users u JOIN users_links l ON u.id=l.id_friend
		WHERE md5(l.id_user)="'.$user.'"
	');
	//amigos
	$friends=$GLOBALS['cn']->query('
		SELECT	f.key AS "key",
				md5(f.value) AS "value"
		FROM view_friends f JOIN users_links u ON f.id_friend=u.id_user
		WHERE md5(u.id_friend)="'.$user.'" AND f.key LIKE "%'.$datos.'%"
		LIMIT 0,50;
	');
	return $friends;
}

function view_friendsOfFriends($id=''){
	if ($_SESSION['ws-tags']['ws-user']['id']!=''||$id!=''){
		$user=($id=='')?md5($_SESSION['ws-tags']['ws-user']['id']):md5($id);

		//los que yo sigo - Nivel 1
		dropViews(array('view_friends_level01'));
		$GLOBALS['cn']->query('
			CREATE VIEW view_friends_level01 AS
			SELECT DISTINCT	id_user AS id_user,
							id_friend as id_friend
			FROM users_links
			WHERE md5(id_user)="'.$user.'"
		');

		//los que siguen::Nivel 1
		dropViews(array('view_friends_level02'));
		$GLOBALS['cn']->query('
			CREATE VIEW view_friends_level02 AS
			SELECT
				u.id_user AS id_user,
				u.id_friend AS id_friend
			FROM view_friends_level01 f JOIN users_links u ON f.id_friend=u.id_user
			WHERE md5(u.id_friend)!="'.$user.'" AND u.id_friend NOT IN (select id_friend from view_friends_level01)
			GROUP BY u.id_friend
		');

		//los que siguen::Nivel 2
		dropViews(array('view_friends_level03'));
		$GLOBALS['cn']->query('
			CREATE VIEW view_friends_level03 AS
			SELECT
				u.id_user AS id_user,
				u.id_friend AS id_friend
			FROM view_friends_level02 f JOIN users_links u ON f.id_friend=u.id_user
			WHERE md5(u.id_friend)!="'.$user.'" AND
				u.id_friend NOT IN (select id_friend from view_friends_level01) AND
				u.id_friend NOT IN (select id_friend from view_friends_level02)
			GROUP BY u.id_friend
		');

		//los que siguen::Nivel 3
		dropViews(array('view_friends_level04'));
		$GLOBALS['cn']->query('
			CREATE VIEW view_friends_level04 AS
			SELECT
				u.id_user AS id_user,
				u.id_friend AS id_friend
			FROM view_friends_level03 f JOIN users_links u ON f.id_friend=u.id_user
			WHERE md5(u.id_friend)!="'.$user.'" AND
				u.id_friend NOT IN (select id_friend from view_friends_level01) AND
				u.id_friend NOT IN (select id_friend from view_friends_level02) AND
				u.id_friend NOT IN (select id_friend from view_friends_level03)
			GROUP BY u.id_friend
		');

		//los que siguen::Nivel 4
		dropViews(array('view_friends_level05'));
		$GLOBALS['cn']->query('
			CREATE VIEW view_friends_level05 AS
			SELECT
				u.id_user AS id_user,
				u.id_friend AS id_friend
			FROM view_friends_level04 f JOIN users_links u ON f.id_friend=u.id_user
			WHERE md5(u.id_friend)!="'.$user.'" AND
				u.id_friend NOT IN (select id_friend from view_friends_level01) AND
				u.id_friend NOT IN (select id_friend from view_friends_level02) AND
				u.id_friend NOT IN (select id_friend from view_friends_level03) AND
				u.id_friend NOT IN (select id_friend from view_friends_level04)
			GROUP BY u.id_friend
		');

		//los que siguen::Nivel 5
		dropViews(array('view_friends_level06'));
		$GLOBALS['cn']->query('
			CREATE VIEW view_friends_level06 AS
			SELECT
				u.id_user AS id_user,
				u.id_friend AS id_friend
			FROM view_friends_level05 f JOIN users_links u ON f.id_friend=u.id_user
			WHERE md5(u.id_friend)!="'.$user.'" AND
				u.id_friend NOT IN (select v.id_friend from view_friends_level01 v) AND
				u.id_friend NOT IN (select w.id_friend from view_friends_level02 w) AND
				u.id_friend NOT IN (select x.id_friend from view_friends_level03 x) AND
				u.id_friend NOT IN (select y.id_friend from view_friends_level04 y) AND
				u.id_friend NOT IN (select z.id_friend from view_friends_level05 z)
			GROUP BY u.id_friend
		');

		//unificacion de las vistas
		dropViews(array('view_friends_level07'));
		$GLOBALS['cn']->query('
			CREATE VIEW view_friends_level07 AS
				(SELECT id_user,id_friend FROM view_friends_level02)
			UNION
				(SELECT id_user,id_friend FROM view_friends_level03)
			UNION
				(SELECT id_user,id_friend FROM view_friends_level04)
			UNION
				(SELECT id_user,id_friend FROM view_friends_level05)
			UNION
				(SELECT id_user,id_friend FROM view_friends_level06)
		');

		//query
		$friends=$GLOBALS['cn']->query('
			SELECT
				f.id_user,
				f.id_friend,
				CONCAT(u.`name`," ",u.last_name) AS name_user,
				CONCAT(u.`name`," ",u.last_name) AS name,
				u.description AS description,
				md5(CONCAT(u.id,"_",u.email,"_",u.id)) AS code,
				u.username AS username,
				u.profile_image_url AS photo_friend,
				u.profile_image_url AS photo,
				u.email as email,
				u.followers_count,
				u.friends_count,
				u.following_count,
				u.followers_count AS admirers,
				u.following_count AS admired,
				u.friends_count AS friends,
				u.country as country,
				md5(CONCAT(u.id,"_",u.email,"_",u.id)) AS code_friend
			FROM users u INNER JOIN view_friends_level07 f ON u.id=f.id_friend
			WHERE u.status="1"
			LIMIT 0,50
		');
		return $friends;

	}else{

		$friends=$GLOBALS['cn']->query('
			SELECT
				CONCAT(u.`name`," ",u.last_name) AS name_user,
				CONCAT(u.`name`," ",u.last_name) AS name,
				md5(CONCAT(u.id,"_",u.email,"_",u.id)) AS code,
				u.description,
				u.profile_image_url AS photo_friend,
				u.profile_image_url AS photo,
				u.username AS username,
				u.email as email,
				u.country as country,
				u.followers_count,
				u.following_count,
				u.friends_count,
				u.followers_count AS admirers,
				u.following_count AS admired,
				u.friends_count AS friends,
				md5(CONCAT(u.id,"_",u.email,"_",u.id)) AS code_friend,
				u.id as id_friend
			FROM users u
			WHERE u.status="1"
			ORDER BY RAND()
			LIMIT 0,50
		');
		return $friends;

	}//else
}

function randSuggestionFriends($not_ids,$limit=10){
	$criterio=($not_ids!='')?'u.id NOT IN ('.$not_ids.') AND':'';
	$query=$GLOBALS['cn']->query('
		SELECT
			u.id AS id_user,
			u.id AS id_friend,
			CONCAT(u.`name`," ",u.last_name) AS name_user,
			u.username AS username,
			u.email as email,
			u.country as country,
			u.description AS description,
			u.followers_count,
			u.friends_count,
			u.profile_image_url AS photo_friend,
			md5(CONCAT(u.id,"_",u.email,"_",u.id)) AS code_friend
		FROM users u
		WHERE '.$criterio.'
			u.id!="'.$_SESSION['ws-tags']['ws-user']['id'].'" AND
			u.id NOT IN (select f.id_friend from users_links f where f.id_user="'.$_SESSION['ws-tags']['ws-user']['id'].'")
		ORDER BY RAND()
		LIMIT 0,'.$limit
	);
	return $query;
}

function groups($where='',$limit=5,$ini=0){
	if($where!='') $where='AND '.$where;
	if($limit<=0||$limit==null) $limit=50;

	$groups=$GLOBALS['cn']->query('
		SELECT
			g.name AS name,
			g.description AS des,
			g.icon AS icon,
			g.id_privacy AS privacy,
			g.photo AS photo,
			g.id AS id,
			(SELECT CONCAT(p.name," ",p.last_name) AS nombre_completo FROM users p WHERE g.id_creator=p.id) AS name_creator,
			(SELECT COUNT(*) AS num FROM users_groups u WHERE g.id=u.id_group) AS num_members,
			g.id_oriented AS oriented
		FROM groups g
		WHERE g.status=1 AND g.id_privacy!=3
		'.$where.'
		ORDER BY num_members DESC
		LIMIT '.$ini.','.$limit
	);
	return $groups;
}

function users($where='',$limit=3,$ini=0){
	if($limit<=0||$limit==null) $limit=50;
	$uid=$_SESSION['ws-tags']['ws-user']['id'];
	$users=$GLOBALS['cn']->query('
		SELECT
			u.id AS id_friend,
			CONCAT(u.`name`," ",u.last_name) AS name_user,
			u.username AS username,
			u.description,
			u.email as email,
			u.country as country,
			u.followers_count,
			u.friends_count,
			u.profile_image_url AS photo_friend,
			md5(CONCAT(u.id,"_",u.email,"_",u.id)) AS code_friend,
			(SELECT `id_user` AS `id_user` FROM users_links WHERE `id_friend`=u.id AND `id_user`='.$uid.') AS follower
		FROM users u
		'.$where.'
		ORDER BY u.name
		LIMIT '.$ini.','.$limit
	);
	return $users;
}
//nuevas funciones para la busqueda procurar eliminar las otras
function peoples($array=''){
	$order='';$limit='LIMIT 0,50';$where='1';
    $uid=$_SESSION['ws-tags']['ws-user']['id'];
    $from=      'users u';
    $select=    'u.id AS id,
    			CONCAT(u.`name`," ",u.last_name) AS name_user,
    			u.username AS username,
    			u.description,
    			u.email as email,
    			u.country as id_country,
                (SELECT name FROM countries WHERE id=u.country) AS country,
    			u.followers_count,
    			u.friends_count,
                u.following_count,
    			u.profile_image_url AS photo_friend,
    			md5(CONCAT(u.id,"_",u.email,"_",u.id)) AS code_friend,
    			(SELECT `id_user` AS `id_user` FROM users_links WHERE `id_friend`=u.id AND `id_user`='.$uid.') AS follower';
    if (isset($array['select'])){       $select.=$array['select']; }
    elseif(isset($array['newSelect'])){ $select=$array['newSelect']; }
    if (isset($array['from'])){         $from=$array['from']; }
    elseif(isset($array['join'])){      $from.=$array['join']; }
    if (isset($array['where'])){        $where=$array['where']; }
    if (isset($array['limit'])){        $limit=$array['limit']; }
    if (isset($array['order'])){        $order=$array['order']; }
    $sql=   'SELECT '.$select.' '.
            'FROM   '.$from.' '.
            'WHERE  '.$where.
            ' '.$order.' '.$limit;
    if (isset($_GET['debug']) && isset($_GET['return'])) return '<pre>'.$sql.'</pre>';
    elseif (isset($_GET['debug'])) echo '<div><pre>'.$sql.'</pre></div>';
	$users=$GLOBALS['cn']->query($sql);
	return $users;
}
function groupss($array=''){
    $uid=$_SESSION['ws-tags']['ws-user']['id'];
	$order='';$limit='LIMIT 0,10';$where='1';
    $from='groups g';
    $select='
		DATE(g.date) AS fecha,
		g.name AS name,
		g.description AS des,
		g.icon AS icon,
		g.id_privacy AS privacy,
		g.photo AS photo,
		md5(g.id) AS id,
		g.id_creator AS creator,
		(SELECT COUNT(*) AS num FROM users_groups u WHERE g.id=u.id_group) AS num_members,
		g.id_oriented AS oriented
	';
    if (isset($array['select'])){       $select.=$array['select']; }
    elseif(isset($array['newSelect'])){ $select=$array['newSelect']; }
    if (isset($array['from'])){         $from=$array['from']; }
    elseif(isset($array['join'])){      $from.=$array['join']; }
    if (isset($array['where'])){        $where=$array['where']; }
    if (isset($array['limit'])){        $limit=$array['limit']; }
    if (isset($array['order'])){        $order=$array['order']; }
    $sql='SELECT '.$select.' FROM '.$from.' WHERE '.$where.' '.$order.' '.$limit;
    if (isset($_GET['debug']) && isset($_GET['return'])) return '<pre>'.$sql.'</pre>';
    elseif (isset($_GET['debug'])) echo '<pre>'.$sql.'</pre>';
	$users=$GLOBALS['cn']->query($sql);
	return $users;
}
function tags($where='',$limit=5){
	if($where==''){ return null; }
	if(substr($where,0,1)!='#'){ $where='#'.$where;/*return null;*/ }
	$lim=($limit!='')?"LIMIT 0,".$limit :'';
    $sql='  SELECT
    			t.id,
    			CONCAT(t.text," ",t.text2," ",t.code_number) as text
    		FROM tags t
    		JOIN users u ON u.id=t.id_user
    		WHERE CONCAT(t.text," ",t.text2," ",t.code_number) LIKE "%'.$where.'%" AND t.status="1"
    		ORDER BY t.id DESC
    		'.$lim;
    if (isset($_GET['debug']) && isset($_GET['return'])) return '<pre>'.$sql.'</pre>';
    elseif (isset($_GET['debug'])) echo '<div><pre>'.$sql.'</pre></div>';
	$hashTags=$GLOBALS['cn']->query($sql);
	return $hashTags;
}
function product($array){
        $select="   p.id,
                    p.id_user,
                    (SELECT CONCAT(a.name,' ',a.last_name) FROM users a WHERE a.id=p.id_user) AS seller,
                    (SELECT type FROM users a WHERE a.id=p.id_user) AS type_user,
                    p.id_status AS status,
                    (SELECT name FROM store_category WHERE id=p.id_category) AS category,
                    (SELECT name FROM store_sub_category WHERE id=p.id_sub_category) AS subCategory,
                    p.name AS name,
                    p.description AS description,
                    p.sale_points AS cost,
                    p.id_category,
                    p.photo AS photo,
                    p.stock AS stock,
                    p.place AS place,
                    p.join_date AS join_date";
        $from='     store_products p';
        $where="1";
        $order=" ORDER BY p.update_date DESC,p.id DESC ";
        $limit=" LIMIT ".$_GET['limitIni'].",9";

        if (isset($array['select'])){       $select.=$array['select']; }
        elseif(isset($array['newSelect'])){ $select=$array['newSelect']; }
        if (isset($array['from'])){         $from=$array['from']; }
        elseif(isset($array['join'])){      $from.=$array['join']; }
        if (isset($array['where'])){        $where=$array['where']; }
        if (isset($array['limit'])){        $limit=$array['limit']; }
        if (isset($array['order'])){        $order=$array['order']; }
        
        $sql='  SELECT '.$select.'
                FROM '.$from.'
                WHERE '.$where.' '.$order.' '.$limit;
        if (isset($_GET['debug']) && isset($_GET['return'])) return '<pre>'.$sql.'</pre>';
        elseif (isset($_GET['debug'])) echo '<pre>'.$sql.'</pre>';
        $result=$GLOBALS['cn']->query($sql);
        return $result;
}
//hasta aqui las funciones para la busqueda
function productHash($where='',$limit=5){
	if($where==''){
		return null;
	}
	if(substr($where,0,1)!='#'){
		$where='#'.$where;//return null;
	}
	$lim=($limit!='')?"LIMIT 0,".$limit :'';

	$pHash=$GLOBALS['cn']->query('
		SELECT
			t.id,
			t.description as description
		FROM store_products t
		WHERE t.description LIKE "%'.$where.'%" AND t.id_status="1"
		ORDER BY t.id DESC
		'.$lim
	);
	return $pHash;
}

function productS($where='',$limit=3){
	if($where==''){
		return null;
	}
	
	$lim=($limit!='')?"LIMIT 0,".$limit :'';

	return $GLOBALS['cn']->query('
		SELECT
			t.id,
			t.name AS name,
			(SELECT name FROM store_category WHERE id=t.id_category) AS category,
			t.photo AS photo
		FROM store_products t
		WHERE t.name LIKE "%'.$where.'%" AND t.id_status="1" AND t.stock>0 AND t.id_user!="'.$_SESSION['ws-tags']['ws-user']['id'].'"
		ORDER BY t.update_date DESC,t.id DESC
		'.$lim
	);
}

function vectorPhash($sch='',$cant=10){
	$cond = ($sch=='')?'WHERE id_status=1 AND stock>0 ORDER BY RAND()':'WHERE id_status=1 AND stock>0 AND name LIKE  "%'.$sch.'%"';
	$hashproduct = $GLOBALS['cn']->query("
		SELECT description
		FROM store_products
		$cond
	");
	$vec = array();
	while($hash = mysql_fetch_assoc($hashproduct)){
		$textHash = get_hashtags($hash['description']);

		foreach ($textHash as &$value){
			$vec[] = rtrim($value,'\,\.');
		}
	}
	$textHash2 = array_unique($vec);
	$i=0;
	foreach ($textHash2 as &$value1){
		if($i<$cant){
				$vecH[] = $value1;
			}
		$i++;
	}
	return $vecH;
}

function followers($id='',$not_ids='',$limit='0,2000'){
	$user=($id=='')?md5($_SESSION['ws-tags']['ws-user']['id']):md5($id);
	$not_ids=($not_ids!='')?' AND l.id_user NOT IN ('.$not_ids.')':'';
	$followers=$GLOBALS['cn']->query('
		SELECT
			l.id_user AS id_user,
			l.id_friend as id_friend,
			CONCAT(u.`name`," ",u.last_name) AS name_user,
			u.profile_image_url AS photo_friend,
			u.email,
			u.country,
			u.followers_count,
			u.friends_count,
			md5(CONCAT(u.id,"_",u.email,"_",u.id)) AS code_friend
		FROM users u JOIN users_links l ON u.id=l.id_user
		WHERE md5(l.id_friend)="'.$user.'" '.$not_ids.' AND l.is_friend = 0
		ORDER BY CONCAT(u.`name`," ",u.last_name)
		LIMIT '.$limit.';'
		);
	return $followers;
}

function following($id='',$limit='0,2000'){
	$user=($id=='')?md5($_SESSION['ws-tags']['ws-user']['id']):md5($id);
	$following=$GLOBALS['cn']->query('
		SELECT
			l.id_user,
			l.id_friend,
			CONCAT(u.`name`," ",u.last_name) AS name_user,
			u.profile_image_url AS photo_friend,
			u.email,
			u.country,
			u.followers_count,
			u.friends_count,
			md5(CONCAT(u.id,"_",u.email,"_",u.id)) AS code_friend
		FROM users u JOIN users_links l ON u.id=l.id_friend
		WHERE md5(l.id_user)="'.$user.'" AND l.is_friend = 0
		ORDER BY name_user ASC
		LIMIT '.$limit.';'
		);
	return $following;
}

function factorPublicity($type,$monto){
	$costos=$GLOBALS['cn']->query('SELECT MAX(cost) AS cost FROM cost_publicity WHERE id_typepublicity="'.$type.'"');
	$costo=mysql_fetch_assoc($costos);

	return intval(($costo[cost]!='')?($monto/$costo['cost']):0);
}

function factorBuyPoints($monto){
	$costos=$GLOBALS['cn']->query('
		SELECT MAX(cost) AS cost
		FROM cost_points
		WHERE id_typecurrency="1"
	');
	$costo=mysql_fetch_assoc($costos);
	return intval(($costo[cost]!='')?($monto/$costo['cost']):0);
}

function redimensionar($original,$img_nueva,$width,$height=''){
	$type=Array(1=>'gif',2=>'jpg',3=>'png');
	//_imprimir(getimagesize($original));
	list($_width,$_height,$tipo,$imgAttr)=getimagesize($original);
	$type=$type[$tipo];
	switch($type){
		case 'jpeg':
		case 'jpg':$img=imagecreatefromjpeg($original);break;
		case 'gif':$img=imagecreatefromgif($original);break;
		case 'png':$img=imagecreatefrompng($original);break;
	}
	//Obtengo la relacion de escala
	if($_width>$width&&$width>0)
		$percent=(double)(($width*100)/$_width);
	if($_width<=$width)
		$percent=100;
	if(floor(($_height*$percent)/100)>$height&&$height>0)
		$percent=(double)(($height*100)/$_height);
	$width=($_width*$percent)/100;
	$height=($_height*$percent)/100;
	//crea imagen nueva redimencionada
	$thumb=imagecreatetruecolor($width,$height);
	if($type=='gif'||$type=='png'){
		#se mantiene la transparencia de la imagen
		$colorTransparancia=imagecolortransparent($img);#devuelve el color usado como transparencia o -1 si no tiene transparencias
		if($colorTransparancia!=-1)$colorTransparente=imagecolorsforindex($img,$colorTransparancia);//devuelve un array con las componentes de lso colores RGB + alpha
		$idColorTransparente=imagecolorallocatealpha($thumb,$colorTransparente['red'],$colorTransparente['green'],$colorTransparente['blue'],$colorTransparente['alpha']);//Asigna un color en una imagen retorna identificador de color o FALSO o -1 apartir de la version 5.1.3
		imagefill($thumb,0,0,$idColorTransparente);//rellena de color desde una cordenada,en este caso todo rellenado del color que se definira como transparente
		imagecolortransparent($thumb,$idColorTransparente);//Ahora definimos que en la nueva imagen el color transparente sera el que hemos pintado el fondo.
	}
	#redimensionar imagen original copiandola en la imagen nueva
	imagecopyresampled($thumb,$img,0,0,0,0,$width,$height,$_width,$_height);
	#guardar la imagen redimensionada donde indica $img_nueva
	switch($type){
		case 'jpeg':
		case 'jpg':
		case 'gif'://imagegif($thumb,$img_nueva);break;
		case 'png'://imagepng($thumb,$img_nueva);break;
			imagejpeg($thumb,$img_nueva,90);
	}
	imagedestroy($img);
	imagedestroy($thumb);
	return true;
}
function CreateThumb($original,$img_nueva,$tamanio,$x,$y,$ancho,$alto){
	$type=Array(1=>'gif',2=>'jpg',3=>'png');
	//obtener atributos de imagen original
	list($imgWidth,$imgHeight,$tipo,$imgAttr)=getimagesize($original);
	$type=$type[$tipo];
	switch($type){
		case 'jpg':
		case 'jpeg':$img=imagecreatefromjpeg($original);break;
		case 'gif':$img=imagecreatefromgif($original);break;
		case 'png':$img=imagecreatefrompng($original);break;
	}
	//crea imagen nueva redimencionada
	$thumb=imagecreatetruecolor ($tamanio,$tamanio);
	if($type=='gif'||$type=='png'){
		imagepalettecopy($thumb,$img);
		$transparentcolor=imagecolortransparent($img);
		if($transparentcolor!=-1)$transparentcolor=imagecolorsforindex($img,$transparentcolor);//devuelve un array con las componentes de lso colores RGB + alpha
		$idColorTransparente=imagecolorallocatealpha($thumb,$transparentcolor['red'],$transparentcolor['green'],$transparentcolor['blue'],$transparentcolor['alpha']);//Asigna un color en una imagen retorna identificador de color o FALSO o -1 apartir de la version 5.1.3
		imagefill($thumb,0,0,$idColorTransparente);//rellena de color desde una cordenada, en este caso todo rellenado del color que se definira como transparente
		imagecolortransparent($thumb,$idColorTransparente);
	}
	//redimensionar imagen original copiandola en la imagen nueva
	imagecopyresampled($thumb,$img,0,0,$x,$y,$tamanio,$tamanio,$ancho,$alto);
	//guardar la imagen redimensionada donde indica $img_nueva
	switch($type){
		case 'jpg':
		case 'jpeg':imagejpeg($thumb,$img_nueva);break;
		case 'gif':imagegif($thumb,$img_nueva);break;
		case 'png':imagepng($thumb,$img_nueva);break;
	}
	imagedestroy($img);
	imagedestroy($thumb);
}

function sendMail($body,$from,$fromName,$subject,$address,$path=''){
	if(LOCAL) return;
	$mail=new phpmailer();
	$mail->PluginDir=$path.'class/';
	$mail->Mailer	='smtp';
	$mail->Host		='localhost';
	$mail->SMTPAuth	=false;
	$mail->Timeout	=1;

	$mail->IsHTML(true);
	$mail->AddAddress($address);

	$mail->From		=$from;
	$mail->FromName	=$fromName;
	$mail->Subject	=$subject;
	$mail->Body		=$body;

	return $mail->Send();
}

function codeTag($code){
	return substr ('000000000'.str_replace(' ','',$code),-9);
}

/* Cantidad de seguidores de un usuario. Si el usuario tiene
 * mas de 10^6 de seguidores se toma como error y la funcion
 * retorna cero
 */
function mskPoints($points){
	if($points<20000000){
		$len=strlen($points);
		if($points>=999&&$len<7)
			return round(($points/1000),2).' '.CONST_UNITMIL;
		if($len>=7)
			return round(($points/1000000),2).' '.CONST_UNITMILLON;
		return $points;
	}
	return 0;
}

function generaGet(){
	reset($_GET);
	$REQUEST=$_GET;
	return http_build_query($REQUEST);
}

//function generaGet(){
//	reset($_REQUEST);
//	$REQUEST=$_REQUEST;
//	return '?'.http_build_query($REQUEST);
//}

function priceList($type_publicity='4',$status='1'){
	return $GLOBALS['cn']->query("
		SELECT
			(select b.name from currency b where b.id=a.id_typecurrency) AS moneda,
			(select c.name from type_publicity c where c.id=a.id_typepublicity) AS tipo_publi,
			CONCAT(a.click_from,' - ',a.click_to) AS rango,
			a.cost AS costo
		FROM cost_publicity a
		WHERE status='".$status."' AND a.id_typepublicity='".$type_publicity."'
		ORDER BY a.click_from ASC
	");
}

function priceListPoints($status='1'){
	return $GLOBALS['cn']->query("
		SELECT
			(select b.name from currency b where b.id=a.id_typecurrency) AS moneda,
			CONCAT(a.amount_from,' - ',a.amount_to) AS rango,
			a.cost AS costo
		FROM cost_points a
		WHERE status='".$status."'
		ORDER BY a.amount_from ASC
	");
}

function queryTagsUserPublicity($limit=50){
	//seleccion de preferencias del usuario en session
	$preferences=explode('|',usersPreferences());
	foreach ($preferences as $value){
		$like.=" _datox_ LIKE '%".replaceCharacters($value)."%' OR ";
	}
	return
		$GLOBALS['cn']->query("
			SELECT
				(SELECT screen_name FROM users u WHERE u.id=t.id_creator) AS nameUsr,
				(SELECT screen_name FROM users u WHERE u.id=t.id_user) AS nameUsr2,
				(SELECT md5(CONCAT(u.id,'_',u.email,'_',u.id)) FROM users u WHERE u.id=t.id_creator) AS code,
				(SELECT u.profile_image_url FROM users u WHERE u.id=t.id_creator) AS photoUser,
				t.id AS idTag,
				t.id_user AS idUser,
				t.id_creator AS idCreator,
				t.code_number AS code_number,
				t.color_code AS color_code,
				t.color_code2 AS color_code2,
				t.color_code3 AS color_code3,
				t.`text` AS texto,
				t.`text2` AS texto2,
				t.date AS fechaTag,
				t.background AS fondoTag,
				a.link AS enlace,
				md5(a.id) AS id_publicidad,
				t.video_url AS video_url,
				unix_timestamp(t.date) AS date
			FROM users_publicity a INNER JOIN tags t ON a.id_tag=t.id
			WHERE (a.status='1' AND a.click_max>=a.click_current AND a.id_type_publicity='4') AND (".str_replace("_datox_","t.`text`",rtrim($like,' OR '))." OR ".str_replace("_datox_","t.`text2`",rtrim($like,' OR '))." OR ".str_replace("_datox_","t.code_number",rtrim($like,' OR ')).")
			ORDER BY rand()
			LIMIT 0,".$limit."
		");
}

function findThumb($photoUser,$userCode){

	if($photoUser){
		if(file_exists('/img/users/'.$userCode.'/'.generateThumbPath($photoUser))){
			return FILESERVER.'img/users/'.$userCode.'/'.generateThumbPath($photoUser);
		}else{
			return FILESERVER.'img/users/'.$userCode.'/'.$photoUser;
		}
	}else{
		return 'img/users/default.jpg';
	}
}

function getTagQuery($extra=''){ //t=tag,p=product,u=user(owner)
	return '
		SELECT
			t.id,
			t.id			as idTag,
			t.background	as fondoTag,
			t.id_creator	as idOwner,
			t.id_user		as idUser,
			if(p.id is null,u.screen_name,p.name) as nameOwner,
			(SELECT screen_name FROM users WHERE id=t.id_user) as nameUsr,
			if(p.id is null,
				if(u.profile_image_url="","img/users/default.jpg",concat("img/users/",md5(CONCAT(u.id,"_",u.email,"_",u.id)),"/",u.profile_image_url)),
				concat("img/",p.photo)
			) as photoOwner,
			p.id			as idProduct,
			t.text			as texto,
			t.text2			as texto2,
			t.date			as fechaTag,
			t.video_url		as video,
			t.color_code,t.color_code2,t.color_code3,
			t.points,t.code_number,t.profile_img_url,t.status,
			md5(CONCAT(u.id,"_",u.email,"_",u.id)) as code,
			unix_timestamp(t.date) AS date
			'.($extra==''||$extra==' '?'':','.$extra).'
		FROM tags t
		JOIN users u ON u.id=t.id_creator
		LEFT JOIN store_products p ON p.id=t.id_product
	';
}

function getPublicityTagsQuery($extra=''){
	//seleccion de preferencias del usuario en session
	$preferences=usersPreferences();
	if ($preferences){
		$preferences=explode('|',$preferences);
		foreach ($preferences as $value){
			$like[]='_datox_ LIKE "%'.replaceCharacters($value).'%"';
		}
		$like=implode(' OR ',$like);
	}
	return
		getTagQuery($extra?$extra:'
				a.link AS enlace,
				md5(a.id) AS id_publicidad
			').'
			JOIN users_publicity a ON a.id_tag=t.id
			WHERE
				a.status="1"
				AND a.click_max>=a.click_current
				AND a.id_type_publicity="4"'.(
				isset($like)?'AND ('
						.str_replace('_datox_','t.`text`',$like).'
					OR '.str_replace('_datox_','t.`text2`',$like).'
					OR '.str_replace('_datox_','t.code_number',$like).'
				)':'');
}

function getTagData($tid=''){
	$noTag=array('idTag'=>$tid,'code_number'=>'notag','color_code2'=>'#333','photoOwner'=>'img/users/default.jpg','fondoTag'=>$tag[fondoTag]);
	if($tid=='') return $noTag;
	$tid=intToMd5($tid);
	$where=' WHERE substring(md5(t.id),-16)="'.substr($tid,-16).'"';
	if(strlen($tid)==15) $where=' WHERE substring(md5(t.id),-15)="'.substr($tid,-15).'"';
	$tag=$GLOBALS['cn']->queryRow(getTagQuery().$where);
	if($tag['id']=='') return $noTag;
	return $tag;
}

function showSharedTag($tid){
	$cad='img/logo100.png';
	$sql=$GLOBALS['cn']->query('SELECT background FROM tags WHERE substring(md5(id),-15)="'.substr($tid,-15).'"');
	if(mysql_num_rows($sql)<1) return $cad;
	$data=mysql_fetch_assoc($sql);
	$fondoTag=$data['background'];
	return 'includes/imagen.php?ancho=100&tipo=3&img='.(strpos(' '.$fondoTag,'default')?'../':FILESERVER).'img/templates/'.$fondoTag;
}

function showTagMail($backg,$placa,$_texto1,$_texto2,$_texto3,$coloCode,$coloCode2,$coloCode3,$foto_usuario,$nameUser,$video='http://'){
	if($video!='http://'){
		$videoLink ='
			<div id="videoLink" style="width:20px;height:20px;margin-left:10px;margin-bottom:20px;background:none">
				<a href="'.$video.'" target="_blank"><img src="'.DOMINIO.'img/iconvideo.png" alt="video" title="'.WATCH_VIDEO.'" border="0" style="border:0px;margin:0;" /></a>
			</div>
		';
	}

	$cad='
		<table width="650" height="300" border="0" align="center" background="'.$backg.'" style="border-radius:30px;behavior:url(border-radius.htc);-moz-border-radius:30px;-webkit-border-radius:30px;font-family:Verdana,Geneva,sans-serif;background-position:left top;">
			<tr>
				<td background="'.$placa .'" style="background-position:left top" valign="top">
					<table width="605" border="0" align="center" style="margin-top:52px;color:#FFFFFF;margin-left:25px;text-shadow:2px 2px 2px #000;filter:progid:DXImageTransform.Microsoft.Shadow(color=\'#000000\',Direction=135,Strength=4);">
						<tr>
							<td colspan="3" style="color:'.(($coloCode!=' ')?$coloCode:'#FFFFFF').'"><h5 style="font-size:20px;padding:0;width:100%;text-align:center;padding:0;margin:0;">'.$_texto1.'</h5></td>
						</tr>
						<tr>
							<td colspan="3" style="color:'.(($coloCode2!=' ')?$coloCode2:'#FFFFFF').';padding:0;"><p style="padding:0;margin:0;margin-top:-15px;font-size:110px;letter-spacing:-10px;text-transform:uppercase;text-align:center;">'.$_texto2.'</p></td>
						</tr>
						<tr>
							<td colspan="3"><p style="padding:0;margin:0;">&nbsp;</p></td>
						</tr>
						<tr>
							<td width="60" rowspan="2" valign="top" style="padding-top:3px;"><img src="'.$foto_usuario.'" alt="users" border="0" width="60" height="60" style="border:1px solid #FFFFFF" /></td>
							<td width="445"><h4 style="font-size:20px;margin:0;margin-top:-15px;">'.$nameUser.'</h4></td>
							<td width="78" rowspan="2" >'.(($videoLink!='')?$videoLink:'&nbsp;').'</td>
						</tr>
						<tr>
							<td style="color:'.(($coloCode3!=' ')?$coloCode3:'#FFFFFF').'" valign="top"><h6 style="font-size:12px;padding:0;margin:0px;">'.$_texto3.'</h6></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	';
	return $cad;
}

function showPreferencesMail($data){
	if(is_numeric($data)){
		$id_user=$data;
		$limit_p=3;//limite de registro por consulta
		$like	='';
		$usr	=($id_user!='')?$id_user:$_SESSION['ws-tags']['ws-user']['id'];
		$cad	='';
		$query	=$GLOBALS['cn']->query('SELECT preference FROM users_preferences WHERE id_user="'.$usr.'"');//todas las preferencias del usuario

		while ($array=mysql_fetch_assoc($query)){
				$ids=explode(',',$array[preference]);//vector de preferencias
				foreach ($ids as $index){
						if ($index!=''){
							$validar=$GLOBALS['cn']->query("SELECT id_preference,detail FROM preference_details WHERE id='".replaceCharacters($index)."' ");
							if (mysql_num_rows($validar)==0){
								$cad.=$index.'|';
							}else{
								$valida=mysql_fetch_assoc($validar);
								$cad.=$valida['detail'].'|';
							}
						}//si el dato no esta vacio

				}//foreach
		}//while

		$camPre=rtrim($cad,'|');

		//selecci?n de preferencias del usuario en session
		$preferences=explode('|',$camPre);
		foreach ($preferences as $value){
			$like.=" _datox_ LIKE '%".replaceCharacters($value)."%' OR ";
		}

		$publicitys=$GLOBALS['cn']->query('
			SELECT
				md5(id) AS id,
				id AS id_valida,
				link,
				picture,
				title,
				message
			FROM users_publicity
			WHERE status="1" AND click_max>=click_current AND id_type_publicity="2" AND ('.str_replace('_datox_','title',rtrim($like,' OR ')).' OR '.str_replace('_datox_','message',rtrim($like,' OR ')).')
			ORDER BY RAND()
			LIMIT 0,'.$limit_p
		);
		$paso=false;
		while ($publicity=mysql_fetch_assoc($publicitys)){
			$lst_publix.='"'.$publicity[id_valida].'",';
			$paso=true;

			$cadPublicity.='
						<div style="width:180%;width:180px;float:left;margin-bottom:10px;height:200px;margin:18px;">
						<div style="display:block;width:160px;height:140px;cursor:pointer;background-position:0 50%;background-repeat:no-repeat;background-color:#FFF">
							 <img src="'.DOMINIO.'includes/imagen.php?ancho=150&alto=120&tipo=2&img='.FILESERVER.'img/publicity/'.$publicity['picture'].'" alt="picture">
						</div>
						<div style="display:block;font-size:11px;text-align:left">
							<strong><a href="'.$publicity['link'].'" onfocus="this.blur()" target="_blank">'.$publicity['title'].'</a></strong>
						</div>
					</div>';
				}

		//relleno con publicidades aleatorias que no tienen que ver con las preferencias del usuario en session
		$limit_relleno=(mysql_num_rows($publicitys)<4)?$limit_p-mysql_num_rows($publicitys):0;//limite de registro por consulta

		$where=(mysql_num_rows($publicitys)==0)?"":" AND id NOT IN (".rtrim($lst_publix,',').") ";

		$rellenos=$GLOBALS['cn']->query('
			SELECT md5(id) AS id,link,picture,title,message
			FROM users_publicity
			WHERE status="1" AND click_max>=click_current AND id_type_publicity="2" '.$where.'
			ORDER BY RAND()
			LIMIT 0,'.$limit_relleno
		);
		//datos que muestra la descripcion de la publicidad $publicity['message']
		if ($limit_relleno>0){
			while ($publicity=mysql_fetch_assoc($rellenos)){

				$cadPublicity.='
					<div style="width:180%;width:180px;float:left;margin-bottom:10px;height:200px;margin:18px;">
						<div style="display:block;width:160px;height:140px;cursor:pointer;background-position:0 50%;background-repeat:no-repeat;background-color:#FFF">
							 <img src="'.DOMINIO.'includes/imagen.php?ancho=150&alto=120&tipo=2&img='.FILESERVER.'img/publicity/'.$publicity['picture'].'" alt="picture">
						</div>
						<div style="display:block;font-size:11px;text-align:left">
							<strong><a href="'.$publicity['link'].'" onfocus="this.blur()" target="_blank">'.$publicity['title'].'</a></strong>
							<br />
						</div>
					</div>';
			}
		}
		return $cadPublicity;
	}else{
		$limit_p=3;//limite de registro por consulta
		$like='';
		$datos=$data.explode('|',$data);

		$tags=$GLOBALS['cn']->query('
		SELECT
			t.id			AS idTag,
			t.code_number	AS code_number,
			t.text			AS texto,
			t.text2			AS texto2
		FROM tags t
		WHERE t.id="'.$datos[1].'"');

		$tag=mysql_fetch_assoc($tags);

		$textDataTag=$tag['code_number'].'|'.$tag['texto'].'|'.$tag['texto2'];

		$camPre=rtrim($textDataTag,'|');

		//selecci?n de preferencias del usuario en session
		$preferences=explode('|',$camPre);
		foreach ($preferences as $value){
			$like.=" _datox_ LIKE '%".replaceCharacters($value)."%' OR ";
		}

		$publicitys=$GLOBALS['cn']->query('
			SELECT
				md5(id) AS id,
				id AS id_valida,
				link,
				picture,
				title,
				message
			FROM users_publicity
			WHERE status="1" AND click_max>=click_current AND id_type_publicity="2" AND ('.str_replace('_datox_','title',rtrim($like,' OR ')).' OR '.str_replace('_datox_','message',rtrim($like,' OR ')).')
			ORDER BY RAND()
			LIMIT 0,'.$limit_p
		);
		$paso=false;
		while ($publicity=mysql_fetch_assoc($publicitys)){
			$lst_publix.='"'.$publicity[id_valida].'",';
			$paso=true;

			$cadPublicity.='
						<div style="width:180%;width:180px;float:left;margin-bottom:10px;height:200px;margin:18px;">
						<div style="border:1px solid #000;display:block;width:160px;height:140px;cursor:pointer;background-position:0 50%;background-repeat:no-repeat;background-color:#FFF">
							<img src="'.DOMINIO.'includes/imagen.php?ancho=150&alto=120&tipo=2&img='.FILESERVER.'img/publicity/'.$publicity['picture'].'" alt="picture">
						</div>
						<div style="display:block;font-size:11px;text-align:left">
							<strong><a href="'.$publicity['link'].'" onfocus="this.blur()" target="_blank">'.$publicity['title'].'</a></strong>
						</div>
					</div>';
				}

		//relleno con publicidades aleatorias que no tienen que ver con las preferencias del usuario en session
		$limit_relleno=(mysql_num_rows($publicitys)<4)?$limit_p-mysql_num_rows($publicitys):0;//limite de registro por consulta

		$where=(mysql_num_rows($publicitys)==0)?"":" AND id NOT IN (".rtrim($lst_publix,',').") ";

		$rellenos=$GLOBALS['cn']->query('
			SELECT md5(id) AS id,link,picture,title,message
			FROM users_publicity
			WHERE status="1" AND click_max>=click_current AND id_type_publicity="2" '.$where.'
			ORDER BY RAND()
			LIMIT 0,'.$limit_relleno
		);
		//datos que muestra la descripcion de la publicidad $publicity['message']
		if ($limit_relleno>0){
			while ($publicity=mysql_fetch_assoc($rellenos)){
				$cadPublicity.='
					<div style="width:180%;width:180px;float:left;margin-bottom:10px;height:200px;margin:18px;">
						<div style="display:block;width:160px;height:140px;cursor:pointer;background-position:0 50%;background-repeat:no-repeat;background-color:#FFF">
							 <img src="'.DOMINIO.'includes/imagen.php?ancho=150&alto=120&tipo=2&img='.FILESERVER.'img/publicity/'.$publicity['picture'].'" alt="picture">
						</div>
						<div style="display:block;font-size:11px;text-align:left">
							<strong><a href="'.$publicity['link'].'" onfocus="this.blur()" target="_blank">'.$publicity['title'].'</a></strong>
							<br />

						</div>
					</div>';
			}
		}
		return $cadPublicity;
	}
}

function showPreferencesMailOthers($data){
	if(is_numeric($data)){
		$id_user=$data;
		$limit_p=3;//limite de registro por consulta
		$like='';
		$usr=($id_user!='')?$id_user:$_SESSION['ws-tags']['ws-user']['id'];
		$cad='';
		$query=$GLOBALS['cn']->query('SELECT preference FROM users_preferences WHERE id_user="'.$usr.'"');//todas las preferencias del usuario
		while ($array=mysql_fetch_assoc($query)){
			$ids=explode(',',$array['preference']);//vector de preferencias
			foreach ($ids as $index){
				if ($index!=''){
					$validar=$GLOBALS['cn']->query("SELECT id_preference,detail FROM preference_details WHERE id='".replaceCharacters($index)."' ");
					if (mysql_num_rows($validar)==0){
						$cad.=$index.'|';
					}else{
						$valida=mysql_fetch_assoc($validar);
						$cad.=$valida['detail'].'|';
					}
				}//si el dato no esta vacio
			}//foreach
		}//while
		$camPre=rtrim($cad,'|');
		//selecci?n de preferencias del usuario en session
		$preferences=explode('|',$camPre);
		foreach ($preferences as $value){
			$like.=" _datox_ LIKE '%".replaceCharacters($value)."%' OR ";
		}
		$publicitys=$GLOBALS['cn']->query('
			SELECT
				md5(id) AS id,
				id AS id_valida,
				link,
				picture,
				title,
				message
			FROM users_publicity
			WHERE status="1" AND click_max>=click_current AND id_type_publicity="2" AND ('.str_replace('_datox_','title',rtrim($like,' OR ')).' OR '.str_replace('_datox_','message',rtrim($like,' OR ')).')
			ORDER BY RAND()
			LIMIT 0,'.$limit_p
		);
		$paso=false;
		while ($publicity=mysql_fetch_assoc($publicitys)){
			$lst_publix.='"'.$publicity['id_valida'].'",';
			$paso=true;
			$cadPublicity.='
				<div style="width:100%;width:180px;float:left;margin-bottom:18px;margin-left:5px;margin-top:18px;margin-right:5px;height:200px;boder:2px #86878a solid;display:inline-block;">
					<div style="display:block;width:160px;height:123px;cursor:pointer;background-position:0 50%;background-repeat:no-repeat;background-color:#FFF;boder:2px #dbdbdb solid;">
						 <img src="'.DOMINIO.'includes/imagen.php?ancho=155&alto=115&tipo=2&img='.FILESERVER.'img/publicity/'.$publicity['picture'].'" alt="picture">
					</div>
					<div style="display:block;font-size:11px;text-align:center;color:#ff8a28;">
						<strong><a href="'.$publicity['link'].'" onfocus="this.blur()" target="_blank">'.$publicity['title'].'</a></strong>
					</div>
				</div>
			';
		}
		//relleno con publicidades aleatorias que no tienen que ver con las preferencias del usuario en session
		$limit_relleno=(mysql_num_rows($publicitys)<4)?$limit_p-mysql_num_rows($publicitys):0;//limite de registro por consulta

		$where=(mysql_num_rows($publicitys)==0)?"":" AND id NOT IN (".rtrim($lst_publix,',').") ";

		$rellenos=$GLOBALS['cn']->query('
			SELECT md5(id) AS id,link,picture,title,message
			FROM users_publicity
			WHERE status="1" AND click_max>=click_current AND id_type_publicity="2" '.$where.'
			ORDER BY RAND()
			LIMIT 0,'.$limit_relleno
		);
		//datos que muestra la descripcion de la publicidad $publicity['message']
		if ($limit_relleno>0){
			while ($publicity=mysql_fetch_assoc($rellenos)){
				$cadPublicity.='
					<div style="boder:2px #86878a groove;display:inline-block;">
						<div style="width:100%;width:180px;float:left;margin-bottom:18px;margin-left:5px;margin-top:18px;margin-right:5px;height:200px;boder:2px #86878a solid;display:inline-block;">
							<div style="display:block;width:160px;height:123px;cursor:pointer;background-position:0 50%;background-repeat:no-repeat;background-color:#FFF;boder:2px #dbdbdb solid;">
								<img src="'.DOMINIO.'includes/imagen.php?ancho=155&alto=115&tipo=2&img='.FILESERVER.'img/publicity/'.$publicity['picture'].'" alt="picture">
							</div>
							<div style="display:block;font-size:11px;text-align:center;color:#ff8a28;">
								<strong><a href="'.$publicity['link'].'" onfocus="this.blur()" target="_blank">'.$publicity['title'].'</a></strong>
								<br />
							</div>
						</div>
					</div>';
			}
		}
		return $cadPublicity;
	}else{
		$limit_p=3;//limite de registro por consulta
		$like='';
		$datos=$data.explode('|',$data);

		$tags=$GLOBALS['cn']->query('
		SELECT
			t.id			AS idTag,
			t.code_number	AS code_number,
			t.text			AS texto,
			t.text2			AS texto2
		FROM tags t
		WHERE t.id="'.$datos[1].'"');

		$tag=mysql_fetch_assoc($tags);

		$textDataTag=$tag['code_number'].'|'.$tag['texto'].'|'.$tag['texto2'];

		$camPre=rtrim($textDataTag,'|');

		//selecci?n de preferencias del usuario en session
		$preferences=explode('|',$camPre);
		foreach ($preferences as $value){
			$like.=" _datox_ LIKE '%".replaceCharacters($value)."%' OR ";
		}

		$publicitys=$GLOBALS['cn']->query('
			SELECT
				md5(id) AS id,
				id AS id_valida,
				link,
				picture,
				title,
				message
			FROM users_publicity
			WHERE status="1" AND click_max>=click_current AND id_type_publicity="2" AND ('.str_replace('_datox_','title',rtrim($like,' OR ')).' OR '.str_replace('_datox_','message',rtrim($like,' OR ')).')
			ORDER BY RAND()
			LIMIT 0,'.$limit_p
		);
		$paso=false;
		while ($publicity=mysql_fetch_assoc($publicitys)){
			$lst_publix.='"'.$publicity['id_valida'].'",';
			$paso=true;

			$cadPublicity.='
				<div style="width:180%;width:180px;float:left;margin-bottom:18px;margin-left:5px;margin-top:18px;margin-right:5px;height:200px;boder:2px #86878a solid;display:inline-block;">
					<div style=" display:block;width:160px;height:123px;cursor:pointer;background-position:0 50%;background-repeat:no-repeat;background-color:#FFF;boder:2px #dbdbdb solid;">
						<img src="'.DOMINIO.'includes/imagen.php?ancho=155&alto=115&tipo=2&img='.FILESERVER.'img/publicity/'.$publicity['picture'].'" alt="picture">
					</div>
					<div style="display:block;font-size:11px;text-align:center;color:#ff8a28;">
						<strong><a href="'.$publicity['link'].'" onfocus="this.blur()" target="_blank">'.$publicity['title'].'</a></strong>
					</div>
				</div>';
		}

		//relleno con publicidades aleatorias que no tienen que ver con las preferencias del usuario en session
		$limit_relleno=(mysql_num_rows($publicitys)<4)?$limit_p-mysql_num_rows($publicitys):0;//limite de registro por consulta

		$where=(mysql_num_rows($publicitys)==0)?"":" AND id NOT IN (".rtrim($lst_publix,',').") ";

		$rellenos=$GLOBALS['cn']->query('
			SELECT md5(id) AS id,link,picture,title,message
			FROM users_publicity
			WHERE status="1" AND click_max>=click_current AND id_type_publicity="2" '.$where.'
			ORDER BY RAND()
			LIMIT 0,'.$limit_relleno
		);
		//datos que muestra la descripcion de la publicidad $publicity['message']
		if ($limit_relleno>0){
			while ($publicity=mysql_fetch_assoc($rellenos)){

				$cadPublicity.='
					<div style="width:180%;width:180px;float:left;margin-bottom:18px;margin-left:5px;margin-top:18px;margin-right:5px;height:200px;boder:1px #86878a solid;display:inline-block;">
						<div style="display:block;width:160px;height:123px;cursor:pointer;background-position:0 50%;background-repeat:no-repeat;background-color:#FFF;boder:1px #dbdbdb solid;">
							 <img src="'.DOMINIO.'includes/imagen.php?ancho=155&alto=115&tipo=2&img='.FILESERVER.'img/publicity/'.$publicity['picture'].'" alt="picture">
						</div>
						<div style="display:block;color:#ff8a28;font-size:11px;text-align:center">
							<strong><a href="'.$publicity['link'].'" onfocus="this.blur()" target="_blank">'.$publicity['title'].'</a></strong>
                                                <dic>
					</div>';
			}
		}

		return $cadPublicity;

	}
}

function formatShowTagMail($idTagRed,$iconoTipo,$msj_sent,$msj_link){
	$tags=$GLOBALS['cn']->query('
		SELECT
			u.screen_name AS nameUsr,
			(SELECT screen_name FROM users WHERE id=t.id_user)	AS nameUsr2,
			md5(CONCAT(u.id,"_",u.email,"_",u.id))			AS code,
			u.profile_image_url				AS photoUser,
			t.id							AS idTag,
			t.id_user						AS idUser,
			t.id_creator					AS idCreator,
			t.code_number					AS code_number,
			t.color_code					AS color_code,
			t.color_code2					AS color_code2,
			t.color_code3					AS color_code3,
			t.text							AS texto,
			t.text2							AS texto2,
			t.date							AS fechaTag,
			t.background					AS fondoTag,
			t.video_url						AS video_url,
			u.email							AS email,
			u.referee_number				AS referee_number
		FROM tags t JOIN users u ON t.id_creator=u.id
		WHERE t.id="'.$idTagRed.'"
	');
	$tag=mysql_fetch_assoc($tags);
	//imagenes del email
	$iconoSpon		=DOMINIO.'/img/menu_users/publicidad.png';
	//$backg			=(strpos(' '.$tag['fondoTag'],'default')?DOMINIO:FILESERVER).'img/templates/'.$tag[fondoTag];//FILESERVER.'img/templates/'.$tag[fondoTag];
	//$placa			=DOMINIO.'img/placaFondo.png';
	//$linkTag		=DOMINIO.'?current=viewTag&tag='.md5($tag['idTag']).'&referee='.$_SESSION['ws-tags']['ws-user'][code].'&email='.md5($tag[email]);
	$linkTag		=DOMINIO.'#&tag='.$tag['idTag'].'&referee='.$_SESSION['ws-tags']['ws-user']['code'].'&email='.md5($tag['email']);
	$imgTag			=  tagURL($tag['idTag']);
	$videoTag		=($tag['video_url']!=' ')?$tag['video_url']:' ';
	//$foto_usuario	=($tag[photoUser]!=' ')?(FILESERVER."img/users/".$tag[code]."/".generateThumbPath($tag[photoUser])):(DOMINIO."img/users/default.jpg");
	$foto_remitente	= FILESERVER.generateThumbPath("img/users/".$_SESSION['ws-tags']['ws-user']['code']."/".$_SESSION['ws-tags']['ws-user']['photo']);
	//imagenes del email
	$iconoSpon	=DOMINIO.'/img/menu_users/publicidad.png';
	//$backg	=(strpos(' '.$tag['fondoTag'],'default')?DOMINIO:FILESERVER).'img/templates/'.$tag[fondoTag];//FILESERVER.'img/templates/'.$tag[fondoTag];
	//$placa	=DOMINIO.'img/placaFondo.png';
	//$linkTag	=DOMINIO.'?current=viewTag&tag='.md5($tag['idTag']).'&referee='.$_SESSION['ws-tags']['ws-user'][code].'&email='.md5($tag[email]);
	$linkTag	=DOMINIO.'#&tag='.$tag['idTag'].'&referee='.$_SESSION['ws-tags']['ws-user']['code'].'&email='.md5($tag['email']);
	$imgTag		=DOMINIO.'includes/tag.php?tag='.md5($tag['idTag']);
	$videoTag	=($tag['video_url']!=' ')?$tag['video_url']:' ';
	//$foto_usuario	=($tag[photoUser]!=' ')?(FILESERVER."img/users/".$tag[code]."/".generateThumbPath($tag[photoUser])):(DOMINIO."img/users/default.jpg");
	$foto_remitente	=FILESERVER.generateThumbPath("img/users/".$_SESSION['ws-tags']['ws-user']['code']."/".$_SESSION['ws-tags']['ws-user']['photo']);
	//video de la tyag
	if($videoTag!='http://'){
		if((strpos($videoTag,'youtube.com'))||(strpos($videoTag,'youtu.be'))){
			$cad .='<a href="'.$videoTag.'" target="_blank"><img src="'.DOMINIO.'img/iconvideo.png" title="'.WATCH_VIDEO.'" border="0" style="border:0px;margin:0;" alt="video"/></a>';
		}else{
			$cad .='<a href="'.$videoTag.'" target="_blank"><img src="'.DOMINIO.'img/iconvimeo.png" title="'.WATCH_VIDEO.'" border="0" style="border:0px;margin:0;" alt="video"/></a>';
		}
	}
	//datos de la tag
//	$_texto1=($tag['texto']!='&nbsp')?$tag['texto']:'<br/>';
//	$_texto2=(trim($tag['code_number'])!='&nbsp')?$tag['code_number']:'<br/>';
//	$_texto3=(trim($tag['texto2'])!='&nbsp')?$tag['texto2']:'<br/>';
	//datos de la cabecera del correo del usuario
	$query=$GLOBALS['cn']->query('
		SELECT
			CONCAT(u.name," ",u.last_name) AS name_user,
			u.username AS username,
			(SELECT a.name FROM countries a WHERE a.id=u.country) AS pais,
			u.followers_count AS followers,
			u.friends_count AS friends
		FROM users u
		WHERE u.id="'.$_SESSION['ws-tags']['ws-user']['id'].'"
	');
	$array=mysql_fetch_assoc($query);

	if (trim($array['username'])!=''){

		$external=USERS_BROWSERFRIENDSLABELEXTERNALPROFILE.":&nbsp;<span ><a style='color:#999999' href='".DOMINIO.$array['username']."' onFocus='this.blur();' target='_blank'>".DOMINIO.$array['username']."</a><br>";
	}else{
		$external=formatoCadena($_SESSION['ws-tags']['ws-user']['full_name']);
	}
	if (trim($array['pais'])!=''){
		$pais=USERS_BROWSERFRIENDSLABELCOUNTRY.":&nbsp;<span style='color:#999999'>".$array['pais']."</span><br/>";
	}
	$cadCom='
		<div style="border-radius:7px;background:#fff;padding-top:25px">
		<table align="center" width="650" border="0" cellpadding="0" cellspacing="0" style="font-family:Verdana,Geneva,sans-serif;font-size:12px">
			<tr>
				<td>
					<table style="width:100%;">
						<tr>
							<td width="68" style="padding-left:5px;padding-bottom:20px;font-size:14px;text-align:left">
									<img src="'.$foto_remitente.'" border="0" width="60" height="60" style="border:3px #ccc solid;" alt="user" >
							</td>
							<td width="569" style="padding-left:5px;padding-bottom:20px;font-size:12px;text-align:left;">
									<div>
											'.$external.'<br>
											'.$pais.'<br>
											</strong>'.USERS_BROWSERFRIENDSLABELFRIENDS.'('.$array[friends].'),&nbsp;'.USERS_BROWSERFRIENDSLABELADMIRERS.'('.$array['followers'].')</strong>
									</div>
							</td>
						</tr>
					 </table>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="color:#000;padding-left:5px;font-size:14px" >
					<table style="width:100%;">
						<tr>
							<td style="width:20px;">
										<img src="'.$iconoTipo.'" width="16" height="16" border="0" alt="photo"/>
							</td>
							<td style="text-align:left;width:450px;">
								<strong>'.formatoCadena($_SESSION['ws-tags']['ws-user']['full_name']).'</strong>&nbsp;'.formatoCadena($msj_sent).' '.$msj_link.'
							</td>
							<td background="'.DOMINIO.'css/smt/email/yellowbutton_get_started2.png" style="width:140px;height:22px;display:inline-block;background-repeat:no-repeat;padding:10px 14px 5px 5px;">
								<a style="font-weight:bold;color:#2d2d2d;font-size:12px;text-decoration:none" href="'.$linkTag.'">'.MENUTAG_CTRSHAREMAILTITLE2.'</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<br>
					<p><a href="'.$linkTag.'" target="_blank"><img src="'.$imgTag.'" alt="tag"></a></p>
					<br>
				</td>
			</tr>
			<tr>
				<td>
					<center><table>
						<tr>
							<td colspan="2" valign="top" style="border-bottom:1px #f4f4f4 solid;border-top:1px #f4f4f4 solid;padding:8px 0px 0px 0px;">
								<img src="'.DOMINIO.'/css/smt/email/publicidad3.png" alt="publicity">
								&nbsp;
								'.USERPUBLICITY_PAYMENT.'
							</td>
						</tr>
						<tr>
							<td colspan="2" valign="top" style="padding:70px 0px 0px 0px;font-size:13px;text-align:center;height:70px;">
								'.PUBLICITYSPACETEXT.'
							</td>
						</tr>
					</table></center>
				</td>
			</tr>
			<tr>
				<td>
					<center><table>
						<tr>
							<td style="padding-left:5px;text-align:center">'.MENUTAG_CTRSHAREMAILTITLE3.': <a href="'.$linkTag.'">Tagbum.com</a>
							</td>
						</tr>
					</table></center>
				</td>
			</tr>
		</table>
		</div>
	';
	return $cadCom;
	//'.showPreferencesMailOthers($sendDataPublicity).' //linia 1724
}

function formatEmailStore($body,$mens){
	$foto_remitente=FILESERVER.getUserPicture($_SESSION['ws-tags']['ws-user']['code'].'/'.$_SESSION['ws-tags']['ws-user']['photo'],'img/users/default.png');
	//datos de la cabecera del correo del usuario
	$query=$GLOBALS['cn']->query('
		SELECT
			CONCAT(u.name," ",u.last_name) AS name_user,
			u.username AS username,
			(SELECT a.name FROM countries a WHERE a.id=u.country) AS pais,
			u.followers_count AS followers,
			u.friends_count AS friends
		FROM users u
		WHERE u.id="'.$_SESSION['ws-tags']['ws-user']['id'].'"
	');
	$array=mysql_fetch_assoc($query);
	if (trim($array['username'])!=''){
		$external=USERS_BROWSERFRIENDSLABELEXTERNALPROFILE.":&nbsp;<span ><a style='color:#999999' href='".DOMINIO.$array['username']."' onFocus='this.blur();' target='_blank'>".DOMINIO.$array['username']."</a><br>";
	}
	if (trim($array['pais'])!=''){
		$pais=USERS_BROWSERFRIENDSLABELCOUNTRY.":&nbsp;<span style='color:#999999'>".$array['pais']."</span><br/>";
	}
	$cadCom='
		<div style="border-radius:7px;background:#fff;padding-top:25px">
		<table align="center" width="650" border="0" cellpadding="0" cellspacing="0" style="font-family:Verdana,Geneva,sans-serif;font-size:12px">
			<tr>
				<td width="78" style="padding-left:5px;font-size:14px;text-align:left">
					<img src="'.$foto_remitente.'" border="0" width="60" height="60" style="border:1px solid #CCCCCC;margin-left:15px;" alt="purchaser" />
				</td>
				<td width="559" style="padding-left:15px;font-size:12px;text-align:left;">
					<div>
						'.$external.'
						'.$pais.'
						'.USERS_BROWSERFRIENDSLABELFRIENDS.'('.$array['friends'].'),&nbsp;'.USERS_BROWSERFRIENDSLABELADMIRERS.'('.$array['followers'].')
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2" >&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2" style="color:#000;padding-left:5px;font-size:14px" >
					<div >
						<div style="float:left;margin-right:5px;">
						</div>
						<div style=" float:left"><strong>'.$_SESSION['ws-tags']['ws-user']['full_name'].' '.$mens.'</div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="color:#999;text-align:center;font-size:14px;font-weight:bold">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2" valign="top">
					<br>
					'.$body.'
					<br>
				</td>
			</tr>
		</table>
		</div>
		<br><br>
	';
	return $cadCom;
}

function maskBirthday($birthday,$type=1,$format=1){
	$date=explode('-',$birthday);
	switch($type){
		case 1:echo (($format==1)?$birthday:formatoFecha($birthday));break;//full
		case 2:echo (($format==1)?$date[1].'-'.$date[2]:$date[2].'/'.$date[1]);break;//day-month
		case 3:echo INDEX_LBL_PRIVATE;break;//nothing
	}
}

function maskBirthdayApp($birthday,$type=1,$format=1){
	if($birthday!='0000-00-00'&&$birthday!=''){
		$date=explode('-',$birthday);
		switch ($type){
			case 1:return (($format==1)?$birthday:formatoFecha($birthday));break;//full
			case 2:return (($format==1)?$date[1].'-'.$date[2]:$date[2].'/'.$date[1]);break;//day-month
			case 3:return INDEX_LBL_PRIVATE;break;//nothing
		}
	}else{
		return 'none';
	}
}

function isProductTag($idTag){
	$query=$GLOBALS['cn']->query('SELECT id_product FROM tags WHERE id_product!="0" AND id="'.$idTag.'"');
	if(mysql_num_rows($query)>0)
		$query=mysql_fetch_assoc($query);
	else
		return false;
	$idProduct=$query['id_product'];
	$product=$GLOBALS['cn']->query('SELECT id,name,picture,url FROM products_user WHERE id="'.$idProduct.'"');
	return mysql_fetch_assoc($product);
}

function adPreference($preference){
	$cad=mysql_real_escape_string($preference);
	$exist=$GLOBALS['cn']->query('
		SELECT id
		FROM preference_details
		WHERE detail LIKE "'.$cad.'" AND id_preference IN (2,3)
	');
	if(mysql_num_rows($exist)==0){
		$GLOBALS['cn']->query('
			INSERT INTO preference_details SET
				id_preference="2",
				detail="'.$cad.'"
		');
		$GLOBALS['cn']->query('
			INSERT INTO preference_details SET
				id_preference="3",
				detail="'.$cad.'"
		');
	}
}

function isYoutubeVideo($value){
	$isValid=false;
	//validate the url,see:http://snipplr.com/view/50618/
	if (isValidURL($value)){
		//code adapted from Moridin:http://snipplr.com/view/19232/
		$idLength=11;
		$idOffset=3;
		$idStarts=strpos($value,'?v=');
		if ($idStarts===FALSE){
			$idStarts=strpos($value,'&v=');
		}
		if ($idStarts===FALSE){
			$idStarts=strpos($value,'/v/');
		}
		if ($idStarts===FALSE){
			$idStarts=strpos($value,'#!v=');
			$idOffset=4;
		}
		if ($idStarts===FALSE){
			$idStarts=strpos($value,'youtu.be/');
			$idOffset=9;
		}
		if ($idStarts!==FALSE){
			//there is a videoID present,now validate it
			//echo $idStarts+$idOffset;
			$isValid=substr($value,$idStarts+$idOffset,$idLength);
			/*$videoID=substr($value,$idStarts+$idOffset,$idLength);
			$http=new HTTP('http://gdata.youtube.com');
			$result=$http->doRequest('/feeds/api/videos/'.$videoID,'GET');
						//returns Array('headers'=>Array(),'body'=>String);
			$code=$result['headers']['http_code'];
						//did the request return a http code of 2xx?
			if (substr($code,0,1)==2){
				$isValid=$videoID;
			}*/
		}
	}
	return $isValid;
}

function isVimeoVideo($vimeo){
	//$isValid=0;
	if (isValidURL($vimeo)){
		if(preg_match('/https?:\/\/(www\.)?vimeo\.com(\/|\/clip:)(\d+)(.*?)/',$vimeo)){
			$isValid=true;
		}else{
			$isValid=false;
		}
	}
	return $isValid;
}

function regex($name){
	switch($name){
		case 'youtubelong'	:return '/^https?:\\/\\/((m\\.|www\\.)?(youtube\\.com\\/)(embed\\/|watch\\?(.*&)*(v=))(.{11}).*)$/i';
		case 'youtube'		:return '/^https?:\\/\\/((m\\.|www\\.)?(youtube\\.com\\/)(embed\\/|watch\\?(.*&)*(v=))(.{11})|(youtu\\.be\\/(.{11}))).*$/i';//code=7&9
		case 'vimeo'		:return '/^https?:\\/\\/(((vimeo\\.com\\/)))((.{8,}))/i';//code=5
		case 'video'		:return '/^https?:\\/\\/(vimeo\\.com\\/.{8,}|youtu\\.be\\/.{11}.*|(m\\.|www\\.)?youtube\\.com\\/(.+)(v=.{11}).*)?$/i';//video=1
		case 'url'			:return '/^(https?:\/\/\S+|www\.\S+)/';
		case 'validurl'		:return '/^(https?:\\/\\/(www\\.)?([a-z][-a-z0-9]+\\.)?([a-z][-a-z0-9]*)\\.([a-zA-Z]{2}|aero|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel)(\.[a-z]{2})?(\/.*)?)/i';
		default				:return '/.*/i';
	}
}

function isVideo($type,&$value){
	if($type=='youtube')
		return preg_match('/youtu\\.be|youtube\\.com/i',$value);
	elseif($type=='vimeo')
		return preg_match('/vimeo\\.com/i',$value);
}

function isValidURL($value){
	return preg_match('/^((https?:\/\/)?(www\.)?)?([a-z][-a-z0-9]+\.)?([a-z][-a-z0-9]*)(\.[a-zA-Z]{2}|aero|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel)(\.[a-z]{2})?(\/.*)?/i',$value);
}

function isValidEmail($email){
	return preg_match('/^[a-zA-Z0-9]+([][\.a-zA-Z0-9_-])*@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+/',$email);
}

function usersPreferences($usr=''){
	$usr=($usr!='')?$usr:$_SESSION['ws-tags']['ws-user']['id'];
	$cad='';
	$query=$GLOBALS['cn']->query("SELECT preference FROM users_preferences WHERE id_user='".$usr."'");//todas las preferencias del usuario
	while($array=mysql_fetch_assoc($query)){
		$ids=explode(',',$array['preference']);//vector de preferencias
		foreach($ids as $index){
			if($index!=''){
				$validar=$GLOBALS['cn']->query("SELECT id_preference,detail FROM preference_details WHERE id='".replaceCharacters($index)."' ");
				if (mysql_num_rows($validar)==0){
					$cad.=$index.'|';
				}else{
					$valida=mysql_fetch_assoc($validar);
					$cad.=$valida['detail'].'|';
				}
			}//si el dato no esta vacio
		}//foreach
	}//while
	return rtrim($cad,'|');
}

function userPreferencesIds($type,$usr=''){ //esta funciona retorna los ids de las preferencias seleccionadas por el usuario
	$usr=($usr!='')?$usr:$_SESSION['ws-tags']['ws-user']['id'];
	$query=$GLOBALS['cn']->query("SELECT preference FROM users_preferences WHERE id_preference='".$type."' AND id_user='".$usr."'");//todas las preferencias del usuario
	while ($array=mysql_fetch_assoc($query)){
		$ids=explode(',',$array[preference]);//vector de preferencias
		$index=trim($index);
		foreach ($ids as $index){
			if ($index!=''){
				$validar=$GLOBALS['cn']->query("SELECT id FROM preference_details WHERE id='".$index."' ");
				if (mysql_num_rows($validar)>0){
					$valida=mysql_fetch_assoc($validar);
					$arrayPrefe[]=$valida[id];
				}
			}//si el dato no esta vacio
		}//foreach
	}//while
	return $arrayPrefe;
}

function userPreferencesDetails($usr=''){ //esta funciona retorna preferencias propias del usuario (detail)
	$usr=($usr!='')?$usr:$_SESSION['ws-tags']['ws-user']['id'];
	$query=$GLOBALS['cn']->query("SELECT preference FROM users_preferences WHERE id_user='".$usr."'");//todas las preferencias del usuario
	while ($array=mysql_fetch_assoc($query)){
		$ids=explode(',',$array['preference']);//vector de preferencias
		foreach ($ids as $index){
			if ($index!=''){
				$validar=$GLOBALS['cn']->query("SELECT id FROM preference_details WHERE id='".$index."' ");
				if (mysql_num_rows($validar)==0){
					$arrayPrefe[]=$index;
				}
			}//si el dato no esta vacio
		}//foreach
	}//while
	return $arrayPrefe;
}

function incHitsTag($id,$numHits=1,$table='tags_hits'){
	$hits='hits=hits+('.$numHits.')';
	if($table=='tags_hits'){
		$id=current($GLOBALS['cn']->queryRow('SELECT id FROM tags WHERE md5(id)="'.intToMd5($id).'" AND status!=2'));
        if(!existe('tags_hits','id','WHERE id_tag="'.$id.'" AND date=CAST(NOW() AS DATE);')){
            $GLOBALS['cn']->query('INSERT INTO tags_hits (id_tag,date,hits) VALUES ('.$id.',NOW(),'.$numHits.');');
        }else{
            $GLOBALS['cn']->query('UPDATE tags_hits SET '.$hits.' WHERE id_tag="'.$id.'";');
        }
    }else{
        $GLOBALS['cn']->query("UPDATE $table SET $hits WHERE id='".intToMd5($id)."';");
    }
}
function incPoints($type,$source,$id_owner,$id_user=''){
	#buscamos los puntos
	list($p_owner,$p_user)=$GLOBALS['cn']->queryRow('
		SELECT points_owner AS owner,points_user AS user
		FROM action_points
		WHERE status=1 AND id_type="'.$type.'"
	');
	#si no hay puntos cancelamos el proceso
	if($p_owner==0&&$p_user==0) return false;
	#si hay usuario y ya realizo esta accion no se le daran puntos
	if($id_user!=''&&current($GLOBALS['cn']->queryRow('
		SELECT id FROM log_actions
		WHERE status=1 AND id_type="'.$type.'" AND id_source="'.$source.'"  AND id_user="'.$id_user.'"
	'))!='') return false;
	if($p_owner!=0) $GLOBALS['cn']->query("
		UPDATE users SET
			accumulated_points=accumulated_points+($p_owner),
			current_points=current_points+($p_owner)
		WHERE id='$id_owner'
	");
	if($p_user!=0&&$id_user!='') $GLOBALS['cn']->query("
		UPDATE users SET
			accumulated_points=accumulated_points+($p_user),
			current_points=current_points+($p_user)
		WHERE id='$id_user'
	");
	$usr=$id_user!=''?$id_user:$id_owner;
	setLogAction($type,$source,$usr);
	return true;
}
function setLogAction($type,$source,$id_user=''){
	$GLOBALS['cn']->query('UPDATE log_actions SET id_type="'.$type.'",id_source="'.$source.'"'.
		($id_user!=''?',id_user="'.$id_user.'"':''));
	return true;
}

function restaFechaUsers($dFecIni,$dFecFin,$usr=''){
	if($usr!='') $usr=$_SESSION['ws-tags']['ws-user']['id'];
	$query=$GLOBALS['cn']->query('
		SELECT DATEDIFF(NOW(),u.created_at) AS num
		FROM users u
		WHERE u.id="'.$usr.'"
	');
	$array=mysql_fetch_assoc($query);
	return $array['num'];
}

function blockUser($created_at){
	list($anio,$mes,$dia)=explode('-',$created_at);
	if(restaFechaUsers($anio.'-'.$mes.'-'.$dia,date('Y-m-d'))>=getNumDaysDemo()&&$_SESSION['ws-tags']['ws-user']['status']=='3'){
		return true;
	}
	return false;
}

function fieldsLogin(){ //campos que se listaran al momento de hacer login en el sistema
	return ' *,DATE(created_at) AS created_at ';
}

function cookie($name,$value=NULL,$expire=NULL,$path='/',$domain=NULL,$secure=false,$httponly=false){
	if($expire===null) $expire=30;
	$expire=time()+60*60*24*$expire;
	if($domain===null) $domain=$_SERVER['SERVER_NAME'];
	if($name!==null) setcookie($name,$value,($value==''?time()-3600:$expire),$path,$domain,$secure,$httponly);
	return $_COOKIE[$name];
}

function cookies($array,$expire=null,$path='/',$domain=null,$secure=false,$httponly=false){
	if($expire===null) $expire=30;
	$expire=time()+60*60*24*$expire;
	if($domain===null) $domain=$_SERVER['SERVER_NAME'];
	if(!is_array($array))
		return array();
	else foreach($array as $name=>$value){
		setcookie($name,$value,($value==''?time()-3600:$expire),$path,$domain,$secure,$httponly);
		$cookies[$name]=$_COOKIE[$name];
	}
	return $cookies;
}

function keepLogin($device=''){
	$res=array( 'logged' => false );
	$keep='';
	$log=intToMd5(isset($_POST['_login_'])?$_POST['_login_']:$_COOKIE['_login_']);
	if($_SESSION['ws-tags']['ws-user']['id']!=''){
		$res['logged']=true;
		if($device=='') return $res;
		#crear el keep login
		$log=md5($device);
		$keep=current($GLOBALS['cn']->queryRow('SELECT md5(concat(id,agent,date)) as keep FROM users_device_login WHERE id="'.$device.'"'));
		$res['kl']=array(
			'_login_'=>$log,
			md5('keep'.$log)=>$keep
		);
		if(!$keep) return $res;
		cookie('_login_',$log);
		cookie(md5('keep'.$log),$keep);
		return $res;
	}
	$res['log']=$log;
	if($keep==''){
		if(preg_match('/seemytag/i',$_SERVER['HTTP_USER_AGENT'])&&isset($_POST[md5('keep'.$log)]))
			$keep=$_POST[md5('keep'.$log)];
		elseif(isset($_COOKIE[md5('keep'.$log)]))
			$keep=$_COOKIE[md5('keep'.$log)];
	}
	if($keep!=''){
//		$res['keepid']=md5('keep'.$log);
		$res['keep']=$keep;
		$query=$GLOBALS['cn']->queryRow('
			SELECT * FROM users_device_login
			WHERE md5(concat(id,agent,date))="'.cls_string($keep).'"
				AND md5(id)="'.cls_string($log).'"
		');
//		$res['querys'][]='query id='.$query['id'].', iduser='.$query['id_user'];
//		$res['querys'][]='USER_AGENT==query_agent? : '.(substr($_SERVER['HTTP_USER_AGENT'],15,25)==substr($query['agent'],15,25)?'true':'false');
		if($query['id']!=''&&substr($_SERVER['HTTP_USER_AGENT'],15,25)==substr($query['agent'],15,25)){
			$sql='SELECT * FROM users WHERE id="'.$query['id_user'].'"';
			$usr=$GLOBALS['cn']->queryRow($sql);
//			$res['usr']=$usr;
			if($usr['status']=='1'||$usr['status']=='3'){
				$res['logged']=true;
				createSession($usr);
				cookie('_login_',$log);
				cookie(md5('keep'.$log),$keep);
			}
		}
	}
    return $res;
}

function ifIsLogged(){
	if($_SESSION['ws-tags']['ws-user']['id']!='')
		cookie('__logged__',md5($_SESSION['ws-tags']['ws-user']['time']));
	else
		cookie('__logged__',NULL);
}

function logout(){
	if(!isset($_GET['nocookies'])){
		cookie(md5('keep'.$_COOKIE['_login_']),NULL);
		cookie('_login_',NULL);
		ifIsLogged();
	}
	unset(
		$_SESSION['ws-tags']['ws-user'],
		$_SESSION['smt-app'],
		$_SESSION['car'],
		$_SESSION['store'],
		$_SESSION['havePaypalPayment']
	);
}

function createSession($array,$clear=true){//creacion de las variables de session del sistema
	if($clear) $usr=$array;
	else{
		$usr=$_SESSION['ws-tags']['ws-user'];
		foreach ($array as $key=>$value){
			$usr[$key]=$value;
		}
	}
	$usr['fullversion']=$_SESSION['ws-tags']['ws-user']['fullversion'];
	$usr['showPhotoGallery']=false;
	if($usr['profile_image_url'] && $usr['photo'] =='') $usr['photo']=$usr['profile_image_url'];
	if($usr['time']==''){//si esta vacio se captura el tiempo, para control de cache en el cliente
		$usr['time']=time();
	}
	if($usr['id']){
		$usr['smt']=$usr['time'].','.md5($usr['id'].md5($usr['time']));
		$usr['full_name']=$usr['name'].' '.$usr['last_name'];
		$usr['code']=md5($usr['id'].'_'.$usr['email'].'_'.$usr['id']);
		$usr['pic']='img/users/'.$usr['code'].'/'.$usr['photo'];
	}
	$_SESSION['ws-tags']['ws-user']=$usr;
	//this variable indicates that photo gallery must be shown on page load
	if($_POST['lng']!=''){
		$_SESSION['ws-tags']['language']=$_POST['lng'];
	}elseif($usr['language']!=''){
		$_SESSION['ws-tags']['language']=$usr['language'];
	}elseif($_POST['lang']!=''){
		$_SESSION['ws-tags']['language']=$_POST['lang'];
	}
    createSessionStore();
	ifIsLogged();
}
function createSessionCar($id_user='',$code='',$count='',$idproduct='',$idOrder='',$comePay=''){
	if($id_user=='') $id_user=$_SESSION['ws-tags']['ws-user']['id'];
	if($code=='') $code=$_SESSION['ws-tags']['ws-user']['code'];
	$carrito=array();
	//en mysql, si utiliza el nombre del campo se puede omitir el AS, y el INNER fue deprecado (INNER JOIN = JOIN)
	if ($count!=''){
		$select='COUNT(p.id) AS num';
	}else{
		$select='
			p.id,
			p.id_user AS seller,
			p.id_category,
			p.id_sub_category,
			(SELECT name FROM store_category WHERE id=p.id_category) AS category,
			(SELECT name FROM store_sub_category WHERE id=p.id_sub_category) AS subCategory,
			p.name,
			od.price AS sale_points,
			p.photo,
			p.place,
			p.stock,
			p.sale_points AS price,
			p.description,
			u.email AS email_seller,
			od.formPayment,
            p.formPayment AS fp,
			od.cant,
			u.paypal,
			o.id AS idOrder
		';
	}
	$sql='
		SELECT
			'.$select.'
		FROM store_orders o
		JOIN store_orders_detail od ON od.id_order=o.id
		JOIN store_products p ON p.id=od.id_product
		JOIN users u ON p.id_user=u.id
		WHERE o.id_user="'.$id_user.'" '.($idOrder!=''?'AND md5(o.id)="'.$idOrder.'" '.($comePay==''?'AND (o.id_status=11 AND od.id_status=11)':''):'AND (o.id_status=1 AND od.id_status=11)').' '.($idproduct!=''?' AND md5(p.id)="'.$idproduct.'"':'').';
	';
	$result=$GLOBALS['cn']->query($sql);
	if ($count==''){
		if (mysql_num_rows($result)>0){
            while ($product=mysql_fetch_assoc($result)){
				if (!$carrito['order']['order']){
					$carrito['order']['order']=$product['idOrder'];
					$carrito['order']['comprador']=$id_user;
					$carrito['order']['comprador_code']=$code;
				}
				unset($product['idOrder']);//borramos del arreglo lo que no queremos guardar
				//se trabajan las variables sobre el mismo arreglo, luego se guarda todo el arreglo
				$product['category']=utf8_encode(formatoCadena(constant($product['category'])));
				$product['subCategory']=utf8_encode(formatoCadena(constant($product['subCategory'])));
				$product['name']=  utf8_encode(formatoCadena($product['name']));
				$carrito[$product['id']]=$product;//guardamos el producto en el carrito
				//Para saber si tiene que pagar productos en paypal
				if($product['formPayment']==1) $_SESSION['havePaypalPayment']=true;
			}
		}
		$_SESSION['car']=$carrito;
		return $carrito;
	}else{
		$product=mysql_fetch_array($result);
		return $product['num'];
	}
}
function createSessionStore(){
    $id_user=$_SESSION['ws-tags']['ws-user']['id'];
	$sql="  SELECT COUNT(od.id_status) AS cant, o.id_status AS status,o.id
            FROM store_orders o
            JOIN  store_orders_detail od ON od.id_order=o.id
            WHERE o.id_user='".$id_user."'
            AND ((o.id_status='11' AND od.id_status='11')
                OR (o.id_status='1' AND od.id_status='11')
                OR (o.id_status='12' AND od.id_status='12')
                OR (o.id_status='5' AND od.id_status='5'))
            GROUP BY o.id_status;";
	$result=$GLOBALS['cn']->query($sql);
    while($row=  mysql_fetch_assoc($result)){
        switch ($row['status']){
            case '1'            : $store['car']=$row['cant']; break;
            case '11': case '12': $store['order']='1'; break;
            case '5'            : $store['wish']=$row['id']; break;
        }
    }
    if ($_SESSION['ws-tags']['ws-user']['type']==1 || $_SESSION['ws-tags']['ws-user']['id']=='427'){
        $sql="  SELECT o.id
                FROM store_orders o
                JOIN store_orders_detail od ON od.id_order=o.id
                WHERE od.id_user='".$id_user."'
                AND od.id_status!='1' AND od.id_status!='2' AND od.id_status!='5'
                LIMIT 1;";
        $result=$GLOBALS['cn']->query($sql);
        $row=  mysql_fetch_assoc($result);
        if ($row['id']!='') $store['sales']='1';
    }
    if (isset($store)){
        $_SESSION['store']=$store;
    }
}
function userExternalReference($keyusr){ //confirmar suscripcion::login
	$query=$GLOBALS['cn']->query('
		SELECT '.fieldsLogin().'
		FROM users
		WHERE md5(md5(concat(id,"_",email,"_",id)))="'.$keyusr.'"
	');
	$array=mysql_fetch_assoc($query);
	if(mysql_num_rows($query)>0){
		crearSession($array);
		//update - colocamos el status del usuario en 3 con la finalidad de cobrar a los 14 dias su suscripcion al sistema
		$status=(($array['type']=='1')?3:1);
		$GLOBALS['cn']->query('UPDATE users SET status="'.$status.'" WHERE id="'.$array['id'].'"');
		$_SESSION['ws-tags']['ws-user']['status']=$status;
		return true;
	}elseif(mysql_num_rows($query)==0){ //validacion de login
		return false;
	}
}

//funciones para obtener datos en especifico

function getNumDaysDemo(){ //numero de dias para la prueba del sistema
	return campo('config_system','id','1','days_block');
}

function getCostAccountIndividual(){ //Costo de suscripcion por personas
	return campo('config_system','id','1','cost_account_individual');
}

function getCostAccountCompany(){ //Costo de suscripcion por empresas
	return campo('config_system','id','1','cost_account_company');
}

function getCostPersonalTagIndividual(){ //Costo para obtener mas personals tags por personas
	return campo('config_system','id','1','cost_individual_personal_tag');
}

function getCostPersonalTagCompany(){ /*Costo para obtener mas personals tags por empresas*/
	return campo('config_system','id','1','cost_company_personal_tag');
}

function getCostPersonalBusinessCard(){ /*this is the price of editing a personal business card*/
	return campo('config_system','id','1','cost_personal_bc');
}

function getCostCompanyBusinessCard(){ /*this is the price of editing a company business *card*/
	return campo('config_system','id','1','cost_company_bc');
}

function getPayBussinesCard($idUser=''){ /*this is to know if the user have paid for his BCs*/
	return campo('users','id',($idUser?$idUser:$_SESSION['ws-tags']['ws-user']['id']),'pay_bussines_card');
}
function getTimeShoppingCarActive(){ /*this is the price of editing a company business *card*/
	return campo('config_system','id','1','time_in_minutes_shopping_cart_active');
}
function getTimeOrderPay(){ /*this is the price of editing a company business *card*/
	return campo('config_system','id','1','time_in_minutes_pending_order_payable');
}

/*INI - funcion en prueba*/
function fillBusinessCardData(&$theUserName,	&$theUserSpecialty,	&$theUserCompany,		&$theUserAddress,	&$theUserPhone,
								&$theUserEmail,	&$theUserLogo,		&$theUserMiddleText,	$bc,				$user=''){
	if($bc){
		/*INI - WHEN CALLED FROM businessCard.view OR userProfile.view*/
		if($bc['company']!='')	$theUserCompany=$bc['company'];
		else						$theUserCompany='Social Media Marketing';
		$theUserAddress=$bc['address'];
		$theUserPhone='';
		$theUserPhone.=$_SESSION['ws-tags']['ws-user']['type']!='1'&&$bc['home_phone']!=''&&$bc['home_phone']!=' '?"<strong>".HOMEPHONE."</strong>:".$bc['home_phone']."&nbsp;":'';
		$theUserPhone.=$bc['work_phone']!=''&&$bc['work_phone']!=' '?"<strong>".WORKPHONE."</strong>: ".$bc['work_phone']."&nbsp;":'';
		$theUserPhone.=$bc['mobile_phone']!=''&&$bc['mobile_phone']!=' '?"<strong>".MOBILEPHONE."</strong>: ".$bc['mobile_phone']."&nbsp;":'';
		$theUserPhone.=$theUserPhone!=''?'<br/>':'';
		$theUserLogo=$bc['company_logo_url'];
		$theUserMiddleText=$bc['middle_text'];
		/*END - WHEN CALLED FROM businessCard.view OR userProfile.view*/
		if(!$user){
			$theUserName=$bc['nameUsr'];
			if($bc['specialty']!='')									$theUserSpecialty=$bc['specialty'];
			elseif($_SESSION['ws-tags']['ws-user']['screenName']!='')	$theUserSpecialty=$_SESSION['ws-tags']['ws-user']['screenName'];
			else														$theUserSpecialty='';
			if($bc['email'])	$theUserEmail=$bc['email'];
			else				$theUserEmail=$_SESSION['ws-tags']['ws-user']['email'];
		}else{/*IF IT'S A NEW BUSINESS CARD*/
			$theUserName		=$user['full_name'];
			$theUserSpecialty	=$user['screen_name'];
			$theUserEmail		=$user['email'];
		}
	}
}
/*FIN - funcion en prueba*/

function uploadFTP($file,$path,$parent='',$borrar=true,$code=''){
	//nombre de archivo y carpeta solamente,parent es para cuando se trabaje desde un include
	$code=$path=='tags'?'':($code?$code:$_SESSION['ws-tags']['ws-user']['code']);
	if(!NOFPT){
		$id_ftp=ftp_connect(FTPSERVER,21);
		ftp_login($id_ftp,FTPACCOUNT,FTPPASS);
		ftp_pasv($id_ftp,false);
		ftp_chdir($id_ftp,$path.'/');
		if($path!='tags'){
			@ftp_mkdir($id_ftp,$code);
			$code.='/';
			ftp_chdir ($id_ftp,$code);
		}
		@ftp_put($id_ftp,'index.html',$parent.'img/index.html',FTP_BINARY);
		ftp_put($id_ftp,$file,$parent.'img/'.$path.'/'.$code.$file,FTP_BINARY);
		ftp_quit($id_ftp);
		if($borrar){
			@unlink($parent.'img/'.$path.'/'.$code.$file);
		}
	}
}

//subir imagenes por FTP. Usar rutas relativas desde dentro de IMG.
function FTPupload($origen,$destino='',$borrar=true,&$id_ftp=false){
	//colocar ruta relativa de origen y destino, incluyendo carpetas.
	//si se omite destino se copia con la misma ruta del origen.
	//por defecto se elimina la imagen original
	if($destino=='') $destino=$origen;
	$count=preg_match('/(.+\/)*/',$destino,$path);
	if(!NOFPT){
		if(!$id_ftp){
			$id_ftp=ftp_connect(FTPSERVER,21);
			ftp_login($id_ftp,FTPACCOUNT,FTPPASS);
			ftp_pasv($id_ftp,false);
		}
		//Movilizacion a subcarpetas. Si no existen las crea.
		//$count=preg_match('/(.+\/)(.+\/)*/',$path[1],$path);
		$path=$path[1];
		while(($pos=strpos($path,'/'))!==false){
			$folder=substr($path,0,$pos);
			@ftp_mkdir($id_ftp,$folder);
			if(ftp_chdir($id_ftp,$folder)){
				@ftp_put($id_ftp,'index.html',RELPATH.'img/index.html',FTP_BINARY);
			}else{
				ftp_quit($id_ftp);
				return false;
			}
			$path=substr($path,$pos+1);
		}
		$file=end(explode('/',$destino));
		if($file!=''){
			ftp_put($id_ftp,$file,RELPATH.'img/'.$origen,FTP_BINARY);
			ftp_quit($id_ftp);
		}
		if($borrar){
			@unlink(RELPATH.$origen);
		}
	}elseif($destino!=$origen){
		mkdir(substr($path[1],0,-1),0777,true);
		if($borrar)
			rename(RELPATH.'img/'.$origen,RELPATH.'img/'.$destino);
		else
			copy(RELPATH.'img/'.$origen,RELPATH.'img/'.$destino);
	}
}
function FTPcopy($origen,$destino){
	$count=preg_match('/(.+\/)*/',$origen,$path);
	if(NOFPT){
		//echo 'origen:'.$origen.'<br>desti:;'.$destino;
		copy(RELPATH.'img/'.$origen,RELPATH.'img/'.$destino);
	}else{
		$id_ftp=ftp_connect(FTPSERVER,21);
		ftp_login ($id_ftp,FTPACCOUNT,FTPPASS);
		ftp_pasv ($id_ftp,false);
		$num=0;
		$path=$path[1];
		while(($pos=strpos($path,'/'))!==false){
			$folder=substr($path,0,$pos);
			if(ftp_chdir($id_ftp,$folder)){
				$num++;
			}else{
				ftp_quit($id_ftp);
				return false;
			}
			$path=substr($path,$pos+1);
		}
		$tmp='ftp_'.rand().'.bin';
		$file=end(explode('/',$origen));
		//echo ftp_pwd($id_ftp).'<br>id_ftp='.$id_ftp.'<br>file='.$file.'<br>relpath='.RELPATH;
		if($count&&ftp_get($id_ftp,RELPATH.'img/'.$tmp,$file,FTP_BINARY)){
			FTPupload($tmp,$destino,true);
		}
	}
}

function copyFTP_Old($file,$pathftp,$pathftpimg,$path='',$rename='',$code=''){
	if(!NOFPT){
		if(!$code){
			$code=$_SESSION['ws-tags']['ws-user']['code'];
		}
		$id_ftp=ftp_connect(FTPSERVER,21);
		ftp_login($id_ftp,FTPACCOUNT,FTPPASS);
		ftp_pasv($id_ftp,false);
		echo $path.'img/temporal/'.$file.'+++++',$pathftp.'/'.$code.'/'.$file.'<br>';
		if(ftp_get($id_ftp,$path.'img/temporal/'.$file,$pathftp.'/'.$code.'/'.$file ,FTP_BINARY)){
			ftp_chdir ($id_ftp,$pathftpimg.'/');
			if($path!='tags'){
				@ftp_mkdir($id_ftp,$code);
				ftp_chdir ($id_ftp,$code.'/');
			}
			@ftp_put ($id_ftp,'index.html',$path.'img/index.html',FTP_BINARY);
			if(ftp_put($id_ftp,($rename?$rename:$file),$path.'img/temporal/'.$file,FTP_BINARY)){
				unlink($path.'img/temporal/'.$file);
			}else{
				return false;
			}
		}else{
			return false;
		}
		return true;
	}else{
		copy(($path?$path:'../../').'img/'.$file,($path?$path:'../../').'img/'.$rename);
	}
}

function deleteFTP($file,$path,$parent=''){
	//nombre de archivo y carpeta solamente, parent es para cuando se trabaje desde un include
	if(!NOFPT){
		$id_ftp=ftp_connect(FTPSERVER,21);
		ftp_login ($id_ftp,FTPACCOUNT,FTPPASS);
		ftp_pasv ($id_ftp,false);
		ftp_chdir ($id_ftp,$path.'/'.($path=='tags'?'':$_SESSION['ws-tags']['ws-user']['code'].'/'));
		//echo ftp_pwd($id_ftp).'/'.$path.'/'.$file.' delete: '.$file.'//////<br>';
		@ftp_delete($id_ftp,$file);
//		if(){
//			echo ' eliminado.++++++++++++';
//		}else{
//			echo ' fallido.++++++++++++';
//		}
		ftp_quit($id_ftp);
	}else{
		@unlink($parent.'img/'.$path.'/'.($path=='tags'?'':$_SESSION['ws-tags']['ws-user']['code'].'/').$file);
	}
}

function renameFTP($fileNew,$fileOld,$path,$parent=''){
	//RE-ESCRIBE UN ARCHIVO
	//echo 'rename: old: '.$fileNew.'--- new: '.$fileOld.'---'.$path.'. ====== . ';
	if(!NOFPT){
		//$old_file='img/'.$path.'/'.($path=='tags'?'':$_SESSION['ws-tags']['ws-user']['code'].'/').$fileOld;
		//$new_file='img/'.$path.'/'.($path=='tags'?'':$_SESSION['ws-tags']['ws-user']['code'].'/').$fileNew;
		$id_ftp=ftp_connect(FTPSERVER,21);
		ftp_login ($id_ftp,FTPACCOUNT,FTPPASS);
		ftp_pasv ($id_ftp,false);
		//echo 'rename: new: '.ftp_pwd($id_ftp).'/'.$path.'/'.$fileNew.'//////<br> rename: old: '.ftp_pwd($id_ftp).'/'.$path.'/'.$fileOld.'//////<br>';
		ftp_chdir ($id_ftp,$path.'/'.($path=='tags'?'':$_SESSION['ws-tags']['ws-user']['code'].'/'));
//		if(fileExistsRemote(ftp_pwd($id_ftp).'/'.$fileNew)){
//			echo ' si existe.++++++++++++';
//		}else{
//			echo ' no existe.++++++++++++';
//		}
		@ftp_rename($id_ftp,$fileNew,$fileOld);
//		if(){
//			echo ' hizo el cambio.++++++++++++';
//		}else{
//			echo ' no lo hizo.++++++++++++';
//		}
		//cerrar la conexión ftp
		ftp_quit($id_ftp);
	}else{
		$old_file='img/'.$path.'/'.($path=='tags'?'':$_SESSION['ws-tags']['ws-user']['code'].'/').$fileOld;
		$new_file='img/'.$path.'/'.($path=='tags'?'':$_SESSION['ws-tags']['ws-user']['code'].'/').$fileNew;
		@rename($parent.$new_file,$parent.$old_file);
	}
}

function opendirFTP($path,$parent=''){
	//nombre carpeta solamente, lista los archivos contenidos en la carpeta
	if(!NOFPT){
		$id_ftp=ftp_connect(FTPSERVER,21);
		ftp_login ($id_ftp,FTPACCOUNT,FTPPASS);
		ftp_pasv ($id_ftp,false);

		$salida=ftp_rawlist($id_ftp,$path);
		/////////////////////date extract
		$_cont=0;
		$rawlist=array();
		foreach ($salida as $v){
			$vinfo=preg_split('/[\s]+/',$v,9);
			if ($vinfo[0]!=='total'&&$vinfo[8]!='.'&&$vinfo[8]!='..'){
				if ($rawlist[strtotime($vinfo[5] . ' ' . $vinfo[6] . ' ' . $vinfo[7])]!=''){
					$rawlist[strtotime($vinfo[5] . ' ' . $vinfo[6] . ' ' . $vinfo[7])+(++$_cont)]=$vinfo[8];
				}else{
					$rawlist[strtotime($vinfo[5] . ' ' . $vinfo[6] . ' ' . $vinfo[7])]=$vinfo[8];
				}
			}
		}
		@krsort($rawlist);//
		////////////////////
		ftp_quit($id_ftp);
		//die ("sdfsdfsdfsdfsdfsdf");
		//print_r($salida);
		return $rawlist;
	}else{
		return @opendir($parent.'img/'.$path);
	}
}

function readdirFTP(&$_array){
	if(!NOFPT){
		$salida=@current($_array);
		@next($_array);
		return $salida;
	}else{
		return @readdir($_array);
	}
}

function fileExistsRemote($path){
	return (@fopen($path,'r')==true);
}

function notifications($id_friend,$id_source,$id_type,$action='',$id_user=''){

		$id_user=($id_user!='')?$id_user:$_SESSION['ws-tags']['ws-user']['id'];

		if ($action==""){

			$notifi=$GLOBALS['cn']->query('
				INSERT INTO users_notifications SET
					id_type		="'.$id_type.'",
					id_source	="'.$id_source.'",
					id_user		="'.$id_user.'",
					id_friend	="'.$id_friend.'",
					revised		="0"
			');

			if ($notifi){ //si se realizo el INSERT envia correo de notificacion

				//query para conseguir el correo del creador de la tag

				if(($id_type==2)||($id_type==4)||($id_type==8)||($id_type==9)){

					$userEmailall=$GLOBALS['cn']->query('
						SELECT
							t.id_creator	AS idCreator,
							u.email			AS email
						FROM tags t JOIN users u ON t.id_creator=u.id
						WHERE t.id="'.$id_source.'"');

					$userEmailAllTag=mysql_fetch_assoc($userEmailall);

				}

				//verificar si el usuario tiene inactivo el envio de correo
				$notifiUsers=$GLOBALS['cn']->query("SELECT * FROM users_config_notifications WHERE id_user='".$id_friend."' and id_notification='".$id_type."'");
				$notifiUser=mysql_fetch_assoc($notifiUsers);

				switch ($id_type){

					case 2://email de favorito

						if($id_friend!=$notifiUser['id_user']){//validar si el usuario no bloqueo el envio de correo

							$nameUserLikes=$GLOBALS['cn']->query("
								SELECT (
									SELECT CONCAT(a.name,' ',a.last_name)
									FROM users a
									WHERE a.id ='".$_SESSION['ws-tags']['ws-user']['id']."'
									) AS name
								FROM users u
								WHERE u.id ='".$_SESSION['ws-tags']['ws-user']['id']."'");

							$nameUserLike=mysql_fetch_assoc($nameUserLikes);

							$iconoTipo=DOMINIO.'/css/smt/tag/like.png';
							if (valid::isEmail($userEmailAllTag['email'])){

								$body=''.formatShowTagMail($id_source,$iconoTipo,NOTIFICATIONS_LIKETAGMSJUSERSENT,NOTIFICATIONS_LIKETAGMSJUSERLINK).'';

								//envio del correo
								//sendMail(formatMail($body,'790'),'no-reply@seemytag.com','Tagbum.com',$nameUserLike[name].' '.MENUTAG_MSJASUNTOFAVORTIO,$userEmailAllTag[email],'../../');
								sendMail(formatMail($body,'790'),'no-reply@seemytag.com',formatoCadena($_SESSION['ws-tags']['ws-user']['full_name']),$nameUserLike['name'].' '.MENUTAG_MSJASUNTOFAVORTIO,$userEmailAllTag['email'],'../../');
							}
						}
					break;

					case 4://email de comentario

						if($id_friend!=$notifiUser['id_user']){//validar si el usuario no bloqueo el envio de correo

							if($userEmailAllTag['idCreator']!=$id_user){

								$iconoTipo=DOMINIO.'/css/smt/tag/comment.png';
								if (valid::isEmail($userEmailAllTag['email'])){

									$body=''.formatShowTagMail($id_source,$iconoTipo,NOTIFICATIONS_COMMENTSTAGMSJUSERSENT,NOTIFICATIONS_COMMENTSTAGMSJUSERLINK).'';

									//envio del correo
									//sendMail(formatMail($body,'750'),'no-reply@seemytag.com','Tagbum.com',MENUTAG_MSJASUNTOCOMMENT,$userEmailAllTag[email],'../../');
									sendMail(formatMail($body,'750'),'no-reply@seemytag.com',formatoCadena($_SESSION['ws-tags']['ws-user']['full_name']),MENUTAG_MSJASUNTOCOMMENT,$userEmailAllTag['email'],'../../');
								}
							}
						}
					break;

					case 8://email de redistribucion

						if($id_friend!=$notifiUser['id_user']){//validar si el usuario no bloqueo el envio de correo

							$iconoTipo=DOMINIO.'/css/smt/tag/redist.png';
							if (valid::isEmail($userEmailAllTag['email'])){

								$body=''.formatShowTagMail($id_source,$iconoTipo,NOTIFICATIONS_REDISTRIBUTIONTAGMSJUSERSENT,NOTIFICATIONS_REDISTRIBUTIONTAGMSJUSERLINK).'';

								//envio del correo
								//sendMail(formatMail($body,'750'),'no-reply@seemytag.com','Tagbum.com',MENUTAG_MSJASUNTOREDISTRIBUTION,$userEmailAllTag[email],'../../');
								sendMail(formatMail($body,'750'),'no-reply@seemytag.com',formatoCadena($_SESSION['ws-tags']['ws-user']['full_name']),MENUTAG_MSJASUNTOREDISTRIBUTION,$userEmailAllTag['email'],'../../');
							}
						}
					break;

					case 9://email de patrocinio

						if($id_friend!=$notifiUser['id_user']){//validar si el usuario no bloqueo el envio de correo

							$iconoTipo=DOMINIO.'/css/smt/tag/sponsor.png';
							if (valid::isEmail($userEmailAllTag['email'])){

								$body=''.formatShowTagMail($id_source,$iconoTipo,NOTIFICATIONS_SPONSORTAGMSJUSERSENT,NOTIFICATIONS_SPONSORTAGMSJUSERLINK).'';

								//envio del correo
								//sendMail(formatMail($body,'750'),'no-reply@seemytag.com','Tagbum.com',MENUTAG_MSJASUNTOSPONSORED,$userEmailAllTag[email],'../../');
								sendMail(formatMail($body,'750'),'no-reply@seemytag.com',formatoCadena($_SESSION['ws-tags']['ws-user']['full_name']),MENUTAG_MSJASUNTOSPONSORED,$userEmailAllTag['email'],'../../');
							}
						}
					break;

				}//end switch

			}

		}else{//else action

			if($id_friend!=$id_user){
				$GLOBALS['cn']->query('
					DELETE FROM users_notifications
					WHERE
						id_type="'.$id_type.'" AND
						id_source="'.$id_source.'" AND
						id_user="'.$id_user.'" AND
						id_friend="'.$id_friend.'"
				');
			}else{
				$GLOBALS['cn']->query('
					DELETE FROM users_notifications
					WHERE
						id_type="'.$id_type.'" AND
						id_source="'.$id_source.'" AND
						id_friend="'.$id_friend.'" AND
						revised="1"
				');
			}
		}

		/*
		$validation=$GLOBALS['cn']->query("
			SELECT id
			FROM users_notifications
			WHERE
				id_type='".$id_type."' AND
				id_source='".$id_source."' AND
				id_user='".$id_user."' AND
				id_friend='".$id_friend."'
		");

		if (mysql_num_rows($validation)==0||$id_type=='4'){
			//if ($id_user!=$id_friend){}
		}
		*/
}

function logAction($id_type,$id_source,$id_user=''){
	if($id_user=='') $id_user=$_SESSION['ws-tags']['ws-user']['id'];
	$insert=$GLOBALS['cn']->query('
		INSERT INTO log_actions SET
			id_type		="'.$id_type.'",
			id_source	="'.$id_source.'",
			id_user		="'.$id_user.'"
	');
	return $insert;
}

function getMonth($pos=1){
	$array=array(
		'',
		JANUARY,
		FEBRURY,
		MARCH,
		APRIL,
		MAY,
		JUNE,
		JULY,
		AUGUST,
		SEPTEMBER,
		OCTOBER,
		NOVEMBER,
		DECEMBER
	);
	return $array[$pos];
}

/* newwwww */
function getCreatingTagPoints(){	/**** points of creating a tag ******************/
	return campo('config_system','id','1','creating_tag_points');
}

function getSharingTagPoints(){	/**** points of mailing a tag *******************/
	return campo('config_system','id','1','sending_tag_points');
}

function getTagPoints($idTag){

	$redistributingTagPoints=campo('config_system','id','1','redistributing_tag_points');
	$redistributingSponsorTagPoints=campo('config_system','id','1','redistributing_sponsor_tag_points');

	$result=$GLOBALS['cn']->query("
		SELECT click_current,click_max
		FROM users_publicity
		WHERE
			id_tag				='".$idTag."' AND
			id_type_publicity	='4' AND
			status				='1';
	");

	if(mysql_num_rows($result)>0){
		$result=mysql_fetch_assoc($result);
		return $result['click_current']<$result['click_max']?$redistributingSponsorTagPoints:$redistributingTagPoints;
	}

	return $redistributingTagPoints;
}

function updateUserCounters($id_user,$field,$inc,$action){

	$usr=($id_user!='')?$id_user:$_SESSION['ws-tags']['ws-user']['id'];

	$query=$GLOBALS['cn']->query(" SELECT $field FROM users WHERE id='".$usr."'");
	$array=mysql_fetch_assoc($query);

	if ($action=='+'){

		$update=$GLOBALS['cn']->query("UPDATE users SET ".$field."=".$field." ".$action." ".$inc." WHERE id='".$id_user."'");

	}elseif($action=='-'&&$array[$field]>=$inc){

		$update=$GLOBALS['cn']->query("UPDATE users SET ".$field."=".$field." ".$action." ".$inc." WHERE id='".$id_user."'");

	}

}

function getUserProfile(&$user_id){
	$profiles=$GLOBALS['cn']->query("SELECT id FROM users WHERE username='".basename($_SERVER['REQUEST_URI'])."' ");
	if (mysql_num_rows($profiles)==0){
		return false;
	}elseif (mysql_num_rows($profiles)>0){
		$profile=mysql_fetch_assoc($profiles);
		$user_id=$profile[id];
		return true;
	}
}

function formatMail_old($body,$width='600'){
	return '
		<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family:Verdana,Geneva,sans-serif;margin:0;padding:0;">
			<tr>
			<td bgcolor="#F4F4F4" align="center">
				<table width="'.$width.'" border="0" align="" cellpadding="0" cellspacing="0" bgcolor="#F4F4F4" style="font-family:Verdana,Geneva,sans-serif;background-image:url('.DOMINIO.'img/bgFormatEmails.jpg);">
				<tr>
					<td width="35" height="35" background="'.DOMINIO.'img/mails/top_izq.png">&nbsp;</td>
					<td height="35" background="'.DOMINIO.'img/mails/top.png">&nbsp;</td>
					<td width="35" height="35" background="'.DOMINIO.'img/mails/top_der.png">&nbsp;</td>
				</tr>
				<tr>
					<td width="35" background="'.DOMINIO.'img/mails/izq.png">&nbsp;</td>
					<td bgcolor="#FFFFFF" style="text-align:left"><a href="http://tagbum.com" target="_blank"><img src="'.DOMINIO.'img/mails/logo.png" width="176" height="77" border="0" alt="Tagbum.com" alt="logo"/></a></td>
					<td width="35" background="'.DOMINIO.'img/mails/der.png">&nbsp;</td>
				</tr>
				<tr>
					<td width="35" background="'.DOMINIO.'img/mails/izq.png">&nbsp;</td>
					<td bgcolor="#FFFFFF" style="font-size:11px;text-align:left;color:#666;" valign="top">'.$body.'</td>
					<td width="35" background="'.DOMINIO.'img/mails/der.png">&nbsp;</td>
				</tr>
				<tr>
					<td width="35" background="'.DOMINIO.'img/mails/izq.png">&nbsp;</td>
					<td bgcolor="#FFFFFF" style="font-size:11px;text-align:left;color:#666;" valign="top">&nbsp;</td>
					<td width="35" background="'.DOMINIO.'img/mails/der.png">&nbsp;</td>
				</tr>
				<tr>
					<td width="35" background="'.DOMINIO.'img/mails/izq.png">&nbsp;</td>
					<td bgcolor="#FFFFFF" style="font-size:9px;color:#999;text-align:left;border-top:1px solid #F4F4F4;">
						'.COPYFOOTER.'&nbsp;/&nbsp;
						<a href="'.DOMINIO.'?viewDialog=terms" onFocus="this.blur();">'.FOOTMENU_TERMS.'</a>&nbsp;/&nbsp;
						<a href="'.DOMINIO.'?viewDialog=privacity" onFocus="this.blur();">'.FOOTMENU_PRIVACY.'</a>
					</td>
					<td width="35" background="'.DOMINIO.'img/mails/der.png">&nbsp;</td>
				</tr>
				<tr>
					<td width="35" height="35"><img src="'.DOMINIO.'img/mails/dow_izq.png" width="35" height="35" border="0" /></td>
					<td height="35"><img src="'.DOMINIO.'img/mails/dow.png" width="100%" height="35" border="0" /></td>
					<td width="35" height="35"><img src="'.DOMINIO.'img/mails/dow_der.png" width="35" height="35" border="0" /></td>
				</tr>
				</table>
			</td>
			</tr>
		</table>
	';
}

function formatMail_old_fondoazul($body,$width='600'){
	return '
		<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family:Verdana,Geneva,sans-serif;margin:0;padding:0;">
			<tr>
			<td background="'.DOMINIO.'img/mails/fondo_correos.png" align="center">
				<table width="'.$width.'" border="0" align="" cellpadding="0" cellspacing="0" style="font-family:Verdana,Geneva,sans-serif;">
				<tr>
					<td width="35" height="35" >&nbsp;</td>
					<td height="35">&nbsp;</td>
					<td width="35" height="35" >&nbsp;</td>
				</tr>
				<tr>
					<td width="35" >&nbsp;</td>
					<td style="text-align:left"><a href="http://tagbum.com" target="_blank"><img src="'.DOMINIO.'img/logo.png" width="176" height="77" border="0" alt="Tagbum.com" /></a></td>
					<td width="35" >&nbsp;</td>
				</tr>
				<tr>
					<td width="35" >&nbsp;</td>
					<td style="font-size:11px;text-align:left;color:#666;" valign="top">
					'.$body.'
					</td>
					<td width="35">&nbsp;</td>
				</tr>
				<tr>
					<td width="35" >&nbsp;</td>
					<td style="font-size:11px;text-align:left;color:#666;" valign="top">&nbsp;</td>
					<td width="35" >&nbsp;</td>
				</tr>
				<tr>
					<td width="35">&nbsp;</td>
					<td style="font-size:9px;color:#fff;text-align:left;border-top:1px solid #F4F4F4;">
						'.COPYFOOTER.'&nbsp;/&nbsp;
						<a style="color:#fff" href="'.DOMINIO.'?viewDialog=terms" onFocus="this.blur();">'.FOOTMENU_TERMS.'</a>&nbsp;/&nbsp;
						<a style="color:#fff" href="'.DOMINIO.'?viewDialog=privacity" onFocus="this.blur();">'.FOOTMENU_PRIVACY.'</a>
					</td>
					<td width="35">&nbsp;</td>
				</tr>
				<tr>
					<td width="35" height="35">&nbsp;</td>
					<td height="35" >&nbsp;</td>
					<td width="35" height="35"	>&nbsp;</td>
				</tr>
				</table>
			</td>
			</tr>
		</table>
	';
}

function formatMail ($body,$width=800){
	return '<table width="'.$width.'" align="center" cellpadding="0" cellspacing="0" style="font-family:\'Lucida Grande\',Tahoma,Verdana,Arial,Sans-Serif;">
            <tr>
                <td style="text-align:right;font-size:10px;padding-bottom:5px;">
                    <a href="'.DOMINIO.'" style="padding-left:5px;text-decoration:none;color:#2d2d2d;" target="_blank">'.EMAILCONTACTNUMBER.''.EMAILCONTACTLETTER.'</a>
                    <span style="padding-left:5px;">|</span>
                    <a href="'.DOMINIO.'#signup" style="padding-left:5px;text-decoration:none;color:#2d2d2d;" target="_blank">'.EMAIL_APP.'<br>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <table background="'.DOMINIO.'css/smt/email/body_bgn2.png" cellpadding="0" cellspacing="0" style="width:100%;border:2px #ccc solid;border-radius:5px;">
                        <tr>
                            <td></td>
                            <td background="'.DOMINIO.'css/tbum/email/bg_logo.png" id="head-logo" style="text-align:right;padding-top:15px;padding-right:15px;">
                                <a href="'.DOMINIO.'" target="blank"><img src="'.DOMINIO.'css/tbum/email/tagbumlogo_1.png" style="float:left;border:none; margin: 40px; max-height:100px;min-height: 100px;height: 100px;" alt="tagbum.com"></a>
                                <a href="'.DOMINIO.'" target="blank"><img src="'.DOMINIO.'css/tbum/email/tagbumlogo_2.png" style="float:right;border:none; margin: 40px;max-height:100px;min-height: 100px;height: 100px;" alt="tagbum.com"></a>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="width:100%;height:25px;text-align:center;">
                                <img src="'.DOMINIO.'css/smt/horizontal_separator.png">
                            </td>
                        </tr>
                        <tr><td></td>
                            <td id="publicity" style="text-align:center;font-size:11px;padding:5px;color:#999999;">
                                '.$body.'
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="width:100%;border:1px #f4f4f4 solid;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <center>
                                    <table  cellspacing="0" cellpadding="0" style=" width:390px;">
                                        <tr>
                                            <td>
                                                <table style="text-align:center;">
                                                    <tr>
                                                        <td>
                                                            <center><table>
                                                                <tr>
                                                                    <td background="'.DOMINIO.'css/smt/email/yellowbutton_for_points.png" style="background-repeat:no-repeat;color:#ff8a28;font-size:11px;height:50px;">
                                                                        <a href="'.DOMINIO.'"  style="padding:38px 27px 10px 24px;">
                                                                            <img src="'.DOMINIO.'css/smt/email/green1000points.png">
                                                                       </a>
                                                                    </td>
                                                                </tr>
                                                            </table></center>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:190px;color:#ff8a28;font-size:11px;">
                                                            <h2 style="-webkit-margin-before:0.23em;-webkit-margin-after:0.23em;">
                                                                <span style="color:#b7b900;">$</span>
                                                                <span style="color:#ff8a28;">'.EMAIL_REDEEMPOINTS.'</span>
                                                                <span style="color:#b7b900;">$</span>
                                                            </h2>
                                                            <span style="color:#000">'.EMAIL_POINTSCollect.'</span>
                                                            '.EMAIL_POINTS.'
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td >
                                                <table background="'.DOMINIO.'css/smt/email/gray_dotter_line.png" style="background-repeat:no-repeat;padding:12px 33px 31px 49px;">
                                                    <tr>
                                                        <td background="'.DOMINIO.'css/smt/email/yellowbutton_get_started.png" style="background-repeat:no-repeat;width:90px;padding:10px;">
                                                            <a  href="'.DOMINIO.'"  style="color:#2d2d2d;font-size:12px;text-decoration:none;padding:8px 26px 8px 10px;">
                                                                <strong >'.EMAIL_INI.'</strong>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td style="text-align:center;">
                                <img src="'.DOMINIO.'css/smt/email/background_buildings.png" style="text-align:center;">
                            </td>
                        </tr>
                        <tr style="border-buttom:1px #ccc solid;border-radius:2px;">
                            <td></td>
                            <td  style="text-align:center;font-size:11px;">
                                <center>
                                    <table cellpadding="0" cellspacing="25" class="font-b" style="color:rgb(255,138,40);font-size:11px;">
                                        <tr>
                                            <td style="text-align:center;">
                                                <a href="'.DOMINIO.'#signup" target="_blank">
                                                    <img src="'.DOMINIO.'css/smt/email/creat_tag_icon.png" style=" padding:11px 23px 7px 23px;border:2px #ccc solid;border-radius:5px;"><br>
                                                </a>
                                                <strong>'.EMAILCREATETAGS.'</strong>
                                            </td>
                                            <td style="text-align:center;">
                                                <a href="'.DOMINIO.'#signup" target="_blank">
                                                    <img src="'.DOMINIO.'css/smt/email/share_tag_icon.png"  style="padding:11px 23px 7px 23px;border:2px #ccc solid;border-radius:5px;"><br>
                                                </a>
                                                <strong>'.EMAILSTAGS.'</strong>
                                            </td>
                                            <td style="text-align:center;">
                                                <a href="'.DOMINIO.'#signup" target="_blank">
                                                    <img src="'.DOMINIO.'css/smt/email/redistribute_tags_icon.png" style="padding:12px 16px 11px 15px;border:2px #ccc solid;border-radius:5px;"><br>
                                                </a>
                                                <strong>'.EMAILRTAGS.'</strong>
                                            </td>
                                            <td style="text-align:center;">
                                                <a href="'.DOMINIO.'#signup" target="_blank">
                                                    <img src="'.DOMINIO.'css/smt/email/sponsor_tags_icon.png"  style="padding:11px 27px 7px 27px;border:2px #ccc solid;border-radius:5px;"><br>
                                                </a>
                                                <strong>'.EMAILSPTAGS.'</strong>
                                            </td>
                                        </tr>
                                    </table>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="border-bottom:1px #ccc solid;">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="font-size:12px;text-align:center;padding:10px;">
                                    '.EMAIL_OPTIONTAGS.' <span style="color:rgb(255,138,40)">'.EMAIL_OPTIONTag.'</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding-top:5px;">
                    <table style="width:100%;">
                        <td id="email-socialMedia">
                            <a href="https://www.facebook.com/pages/Tagbum/182709268463153?ref=ts&fref=ts" target="_blank"><img src="'.DOMINIO.'css/smt/email/facebook.png" style="text-align:left;border:none;"></a>
                            <a href="https://twitter.com/tag_bum" target="_blank"><img src="'.DOMINIO.'css/smt/email/twitter.png" style="text-align:left;border:none;"></a>
                            <a href="http://www.linkedin.com/in/tagbum/" target="_blank"><img src="'.DOMINIO.'css/smt/email/likedIn.png" style="text-align:left;border:none;"></a>
                            <a href="https://plus.google.com/u/0/105016519974283790958" target="_blank"><img src="'.DOMINIO.'css/smt/email/google.png" style="text-align:left;border:none;"></a>
                        </td>
                        <td id="email-pie_terms" style="font-size:10px;text-align:right;">
                            <a href="'.DOMINIO.'#terms" style="padding-right:5px;text-decoration:none;color:#2d2d2d;" target="_blank">'.EMAIL_TERMS.'</a>
                        </td>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width:100%;font-size:11px;color:#cccccc">
                    <center>
                        '.EMAIL_ENDNOTE.'
                    </center>
                </td>
            </tr>
    </table>
    ';
	//cambio que se hizo a peticion del cliente donde se quita la opcion de darse de baja
	//<a href="'.DOMINIO.'#term" style="padding-right:5px;text-decoration:none;color:#2d2d2d;" target="_blank">'.EMAIL_TERMS.'</a>|<a href="'.DOMINIO.'" style="padding-left:5px;text-decoration:none;color:#2d2d2d;" target="_blank">'.EMAIL_UNSUBSCRIBE.'</a>
}

function arrayBackgroundsBlocked($id_user=''){
	$backgrounds=$GLOBALS['cn']->query('
		SELECT background
		FROM tags_delete_backgrounds
		WHERE id_user="'.(($id_user!='')?$id_user:$_SESSION['ws-tags']['ws-user']['id']).'"
	');
	$array=array('');//validacion,si no hay fondos borrados
	while ($background=mysql_fetch_assoc($backgrounds)){
		$array[]=$background['background'];
	}
	return $array;
}

function viewChatFriends($id=''){
		$user=($id=='')?md5($_SESSION['ws-tags']['ws-user']['id']):md5($id);
		dropViews(array('view_friends'));
		//los que el usuario sigue
		$GLOBALS['cn']->query("
			CREATE VIEW view_friends AS
			SELECT DISTINCT
				l.id_user AS id_user,
				l.id_friend as id_friend,
				u.screen_name,
				CONCAT(u.name,' ',u.last_name) AS name_user,
				u.profile_image_url AS photo_friend,
				u.email,
				u.home_phone,
				u.mobile_phone,
				u.work_phone,
				u.chat_last_update,
				md5(CONCAT(u.id,'_',u.email,'_',u.id)) AS code_friend
			FROM users u INNER JOIN users_links l ON u.id=l.id_friend
			WHERE md5(l.id_user)='".$user."';
		");
		//amigos code_friend screen_name name_user photo_friend last_update
		$dif='TIMESTAMPDIFF(MINUTE,f.chat_last_update,now())';
		$friends=$GLOBALS['cn']->query("
			SELECT
				f.name_user AS n,
				f.photo_friend AS p,
				f.code_friend AS c,
				if(f.screen_name='',f.name_user,f.screen_name) as s,
				if($dif>10,'offline',if($dif>5,'away','online')) as 't'
			FROM view_friends f INNER JOIN users_links u ON f.id_friend=u.id_user
			WHERE md5(u.id_friend)='".$user."'
			order by TIMESTAMPDIFF(MINUTE,f.chat_last_update,now()) ASC
			LIMIT 0,50;
		");
		return $friends;
}

function saveDevice($mobile=false){
	$langcode=explode(';',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
	$langcode=explode(',',$langcode['0']);
	$GLOBALS['cn']->query('
		INSERT INTO users_device_login SET
			id_user		="'.$_SESSION['ws-tags']['ws-user']['id'].'",
			agent		="'.str_replace("'","\'",$_SERVER['HTTP_USER_AGENT']).'",
			remote_addr	="'.$_SERVER['REMOTE_ADDR'].'",
			remote_host	="'.$_SERVER['REMOTE_HOST'].'",
			remote_port	="'.$_SERVER['REMOTE_PORT'].'",
			language	="'.$langcode['0'].'",
			is_mobile	="'.($mobile?1:0).'"
	');
	return mysql_insert_id();
}

function registerDevice($mobile){
	$langcode=explode(';',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
	$langcode=explode(',',$langcode['0']);

	$GLOBALS['cn']->query('
		INSERT INTO users_device_login SET
			id_user		="'.$_SESSION['ws-tags']['ws-user']['id'].'",
			agent		="'.str_replace("'","\'",$_SERVER['HTTP_USER_AGENT']).'",
			remote_addr	="'.$_SERVER['REMOTE_ADDR'].'",
			remote_host	="'.$_SERVER['REMOTE_HOST'].'",
			remote_port	="'.$_SERVER['REMOTE_PORT'].'",
			language	="'.$langcode['0'].'",
			is_mobile	="'.$mobile.'"
	');
	return md5(mysql_insert_id());
}

function pointsList($type_publicity='4',$status='1'){
	return $GLOBALS['cn']->query('
		SELECT
			(SELECT name FROM currency WHERE id=a.id_typecurrency) AS moneda,
			(SELECT name FROM type_publicity WHERE id=a.id_typepublicity) AS tipo_publi,
			CONCAT(a.click_from," - ",a.click_to) AS rango,
			a.cost AS costo
		FROM points_publicity a
		WHERE status="'.$status.'" AND a.id_typepublicity="'.$type_publicity.'"
		ORDER BY a.click_from ASC
	');
}

function factorPublicityPoints($type,$points){
	$query=$GLOBALS['cn']->query('
		SELECT factor
		FROM points_publicity
		WHERE id_typepublicity="'.$type.'" AND "'.$points.'" BETWEEN min_points AND max_points
	');

	if(mysql_num_rows($query)==1){
		$result=mysql_fetch_assoc($query);
	}else{
		$query=$GLOBALS['cn']->query('
			SELECT MIN(factor) AS factor
			FROM points_publicity
			WHERE id_typepublicity="'.$type.'"
		');
		$result=mysql_fetch_assoc($query);
	}
	return intval($result['factor']?$points/$result['factor']:0);
}

function generateDivMessaje($id,$width,$content,$success=true,$float=''){
	if($success){
		echo '	<div id="'.$id.'" class="success_message" style="width:'.$width.'px;margin:0 auto;'.($float?"float:$float;":'').'">
					<img src="imgs/message_success.png" width="12" height="12"/>
					&nbsp;'.$content.'
				</div>';
	}else{
		echo '	<div id="'.$id.'" class="error_message" style="width:'.$width.'px;margin:0 auto;'.($float?"float:$float;":'').'">
					<img src="imgs/message_error.png" width="12" height="12"/>
					&nbsp;'.$content.'
				</div>';
	}
}

function replaceCharacters($cad){
	return mysql_real_escape_string($cad);
}

function filterListFolderImagess(){
	return array('.','..','Thumbs.db','_notes','.DS_Store','.svn');
}

function addJs($files){
	if (is_array($files)){
		foreach ($files as $value)
			echo '<script type="text/javascript" src="'.$value.'"></script>';
	}else{
		echo '<script type="text/javascript" src="'.$files.'"></script>';
	}
}

function mysqlFetchAssocToArray($query,$field){
	$_array=array();
	while($array=mysql_fetch_assoc($query))
		$_array[]=$array[$field];
	return $_array;
}

function generateThumbPath($photo,$onlyName=false,$default='img/users/default.jpg'){
	$imagesAllowed=array('jpg','jpeg','png','gif');
	$ext=strtolower(end(explode('.',$photo)));
	if(in_array($ext,$imagesAllowed)&&strpos(" $photo",'img/')){
		$imagen=str_replace(".$ext","_thumb.$ext",$photo);
		if($onlyName||fileExistsRemote(FILESERVER.$imagen)){
			return $imagen;
		}elseif(fileExistsRemote(FILESERVER.$photo)){
			return $photo;
		}
	}
	return $default;
}

function validImgUserfreinds($code,$photo){
	if(($code!='')&&($photo!='')){
		if(@fopen(FILESERVER."img/users/".$code."/".$photo,"r")==true){
			return generateThumbPath("img/users/".$code."/".$photo);
		}else{
			return "img/users/default.jpg";
		}
	}else{
		return "img/users/default.jpg";
	}
}

function noLineBreak($str){
	return str_replace(chr(13),' ',str_replace(chr(10),' ',$str));
}

//groups

function isInTheGroup($id_group,$id_user=''){
	$id_user	=($id_user!='')?$id_user:$_SESSION['ws-tags']['ws-user']['id'];
	$query		=$GLOBALS['cn']->query("SELECT if(is_admin='1','admin','belongs') as 'is' FROM users_groups WHERE id_user='".$id_user."' AND md5(id_group)='".$id_group."'");
	$is			=mysql_fetch_assoc($query);
	return $is['is']!=''?$is['is']:0;
}

function groupsOriented($oriented='',$id_user=''){
	$paso=false;
	$id_user=($id_user!='')?$id_user:$_SESSION['ws-tags']['ws-user']['id'];
	$user_age=edad($_SESSION['ws-tags']['ws-user']['date_birth'],'-');

	$rules=$GLOBALS['cn']->query('
		SELECT id,rule
		FROM groups_oriented
		WHERE id="'.$oriented.'"
	');

	$rule=mysql_fetch_assoc($rules);

	if ($user_age>=$rule['rule'])
		$paso=true;
	return $paso;
}

function ftp_copy($file){
	global $conn_id;
	$ftp_root='/public_html/';
	$site_root='/home/usr/public_html/';
	return ftp_put($conn_id,$ftp_root . $file,$site_root . $file,FTP_BINARY);
}

/* is_set($item,$alter)
 *		Si el item existe, retorna su valor, de lo contrario, retorna el valor alterno
 */
function is_set($item,$alter=false){
	return isset($item)?$item:$alter;
}

//funcion para limpiar y corregir caracteres especiales en una cadena.
function strclean($txt){
	$txt=preg_replace('/&nbsp;?/i',' ',$txt);
	$array=array(
		'\\\\'=>'\\',
		'\\\''=>'\'',
		'\\"'=>'"',
		'&amp;'=>'&'
	);
	return str_replace(array_keys($array),array_values($array),$txt);
}

function convertir_especiales_html($str){
	if (!isset($GLOBALS['carateres_latinos'])){
		$todas=get_html_translation_table(HTML_ENTITIES,ENT_NOQUOTES);
		$etiquetas=get_html_translation_table(HTML_SPECIALCHARS,ENT_NOQUOTES);
		$GLOBALS['carateres_latinos']=array_diff($todas,$etiquetas);
	}
	$str=strtr($str,$GLOBALS['carateres_latinos']);
	return $str;
}

function transferTag($tag_from,$tag_to,$op,$type_notif=""){
	switch ($op){
		case '1':$query=$GLOBALS['cn']->query("UPDATE tags_comments SET id_tag='".$tag_to."' WHERE id_tag='".$tag_from."'");
		break;//comentarios
		case '2':$query=$GLOBALS['cn']->query("UPDATE tags SET source='".$tag_to."' WHERE source='".$tag_from."'");
		break;//redistribuciones
		case '3':$query=$GLOBALS['cn']->query("UPDATE likes SET id_source='".$tag_to."' WHERE id_source='".$tag_from."'");
		break;//likes
		case '4':	$type=($type_notif!='')?" AND id_type='".$type_notif."' ":"";
					$query=$GLOBALS['cn']->query('
						UPDATE users_notifications SET id_source="'.$tag_to.'"
						WHERE id_source="'.$tag_from.'" AND id_type IN (1,2,4,7,8,9,10) '.$type.'
					');
		break;//notifications
	}
}

function updateTagData($old,$new){
	$GLOBALS['cn']->query('UPDATE tags_comments SET id_tag="'.$new.'" WHERE id_tag="'.$old.'"');
	$GLOBALS['cn']->query('UPDATE tags SET source="'.$new.'" WHERE source="'.$old.'"');
	$GLOBALS['cn']->query('UPDATE likes SET id_source="'.$new.'" WHERE id_source="'.$old.'"');
	$GLOBALS['cn']->query('UPDATE users_notifications SET id_source="'.$new.'" WHERE id_source="'.$old.'" AND id_type IN (1,2,4,7,8,9,10)');
	$GLOBALS['cn']->query('UPDATE users_publicity SET id_tag="'.$new.'" WHERE id_tag="'.$old.'"');
}

function limpiaTextComentarios($text){
	$codigos=array('&Agrave;','&agrave;','&Aacute;','&aacute;','&Acirc;','&acirc;','&Atilde;',
		'&atilde;','&Auml;','&auml;','&Aring;','&aring;','&AElig;','&aelig;','&Ccedil;',
		'&ccedil;','&ETH;','&eth;','&Egrave;','&egrave;','&Eacute;','&eacute;','&Ecirc;',
		'&ecirc;','&Euml;','&euml;','&Igrave;','&igrave;','&Iacute;','&iacute;','&Icirc;',
		'&icirc;','&Iuml;','&iuml;','&Ntilde;','&ntilde;','&Ograve;','&ograve;','&Oacute;',
		'&oacute;','&Ocirc;','&ocirc;','&Otilde;','&otilde;','&Ouml;','&ouml;','&Oslash;',
		'&oslash;','&OElig;','&oelig;','&szlig;','&THORN;','&thorn;','&Ugrave;','&ugrave;',
		'&Uacute;','&uacute;','&Ucirc;','&ucirc;','&Uuml;','&uuml;','&Yacute;','&yacute;',
		'&Yuml;','&yuml;');

	$caracteres=array('Ã€','Ã ','Ã�','Ã¡','Ã‚','Ã¢','Ãƒ','Ã£','Ã„','Ã¤','Ã…','Ã¥','Ã†','Ã¦','Ã‡',
		'Ã§','Ã�','Ã°','Ãˆ','Ã¨','Ã‰','Ã©','ÃŠ','Ãª','Ã‹','Ã«','ÃŒ','Ã¬','Ã�','Ã­','ÃŽ',
		'Ã®','Ã�','Ã¯','Ã‘','Ã±','Ã’','Ã²','Ã“','Ã³','Ã�?','Ã´','Ã•','Ãµ','Ã–','Ã¶','Ã˜',
		'Ã¸','Å’','Å“','ÃŸ','Ãž','Ã¾','Ã™','Ã¹','Ãš','Ãº','Ã›','Ã»','Ãœ','Ã¼','Ã�','Ã½',
		'Å¸','Ã¿');

	$text=str_replace($caracteres,$codigos,$text);
	$text=str_replace("	","&nbsp;&nbsp;",$text);//tab
	$text=str_replace(chr(152),'',$text);//tilde de la Ã± Ëœ
	//$text=str_replace('"',"\"",$text);
	$text=str_replace('"',"&quot;",$text);
	$text=str_replace("'","&apos;",$text);
	$text=str_replace("\n\r","\n",$text);
	$text=str_replace("\r\n","\n",$text);
	$text=str_replace("\n","<br>",$text);
	return $text;
}

function validaMobile($campo,$tipo){
	switch ($tipo){
		case 'text':
			return preg_match('/^[a-zA-Z\s\.]+$/i',$campo);
		break;
		case 'email':
			return preg_match('/^[a-zA-Z0-9]+([][\.a-zA-Z0-9_-])*@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+/',$campo);
		break;
		case 'existe':
			$where="WHERE email='".$campo."'";
			return existe('users','email',$where);
		break;
		case 'fecha':
			$dateBirht=explode('/',$campo);
			if(($dateBirht[0]==0)||($dateBirht[1]==0)||($dateBirht[2]==0)){
				return true;
			}else{
				return false;
			}
		break;
	}
}

function updateUsersCounters($id){
	$sql='
		SELECT
			u.id,
			(SELECT COUNT(*) FROM users_links WHERE u.id=id_user	AND is_friend=1) AS friends,
			(SELECT COUNT(*) FROM users_links WHERE u.id=id_user	AND is_friend=0) AS admired,
			(SELECT COUNT(*) FROM users_links WHERE u.id=id_friend	AND is_friend=0) AS admirers
		FROM users u
		WHERE u.id="'.$id.'" OR md5(u.id)="'.$id.'"
	';
	$query=$GLOBALS['cn']->query($sql);
	$data=mysql_fetch_assoc($query);
	//updating users table
	mysql_query('
		UPDATE users SET
			friends_count	="'.$data['friends'].'",
			following_count	="'.$data['admired'].'",
			followers_count	="'.$data['admirers'].'"
		WHERE
			id="'.$data['id'].'"
	') or die('updateUsersCounters -> '.mysql_error());
	return $data;
}

function relativePath($url){
	return str_replace(DOMINIO,'../',str_replace('http://seemytag.com','..',$url));
}

function generateAlbumView($userId,$showEditImages,$rel,$albumName){
	//selecting all photos from album $albumName (except the cover picture)
	$images_profile	=$GLOBALS['cn']->query('
		SELECT i.id,i.image_path
		FROM images i
		JOIN album a ON a.id_user=i.id_user
		WHERE
			i.id_user='.$userId.' AND
			i.id_images_type=2 AND
			a.name="'.$albumName.'" AND
			a.id_image_cover!=i.id
		ORDER BY i.id DESC
	');
	echo '<div style="display:none;">';
	while($image=mysql_fetch_assoc($images_profile)){
		$img_full_src=FILESERVER.'img/users/'.$image['image_path'];
		$showEditImages=($showEditImages?'&showMenu':'');
		echo
			'<a id="'.md5($img_full_src).'" class="grouped_PP" rel="'.$rel.'"'.
				'href="views/photos/picture.view.php?src='.$img_full_src.'&id_photo='.md5($image['id']).'&id_user='.$userId.$showEditImages.'">'.
				'<img src="'.$img_full_src.'" alt=""/>'.
			'</a>';
	}
	echo '</div>';
}

function getPicture($photoPath,$default=''){
	if(fileExistsRemote($photoPath)){
		return $photoPath;
	}
	return $default;
}
function getProfilePicture($photoPath){
	return getPicture(generateThumbPath($photoPath),'css/smt/usr.jpg');
}

function getUserPicture($photo,$default='img/users/default.png'){
	$path='img/users/';
	if(strpos($photo,$path)===false) $photo=$path.$photo;
	if(preg_match('/\S+\.\S+$/',$photo)){
		$thumb=preg_replace('/(\.\S+)$/','_thumb$1',$photo);
		if(fileExistsRemote(FILESERVER.$thumb))
			return $thumb;
		elseif(fileExistsRemote(FILESERVER.$photo))
			return $photo;
	}
	return $default;
}

function request($id){
	return isset($_POST[$id])?$_POST[$id]:$_GET[$id];
}

//funciones para manejo de imagenes
function HexToRGB($hex){
	$hex=str_replace('#','',$hex);
	$color=array();
	if(strlen($hex)==3){
		$color['r']=hexdec(substr($hex,0,1).substr($hex,0,1));
		$color['g']=hexdec(substr($hex,1,1).substr($hex,1,1));
		$color['b']=hexdec(substr($hex,2,1).substr($hex,2,1));
	}elseif(strlen($hex)==6){
		$color['r']=hexdec(substr($hex,0,2));
		$color['g']=hexdec(substr($hex,2,2));
		$color['b']=hexdec(substr($hex,4,2));
	}
	return $color;
}
function imagecolorhexallocate(&$im,$hex){
	if($hex=='') $hex='#fff';
	$color=HexToRGB($hex);
	return imagecolorallocate($im,$color['r'],$color['g'],$color['b']);
}
function imagecolorhexallocatealpha(&$im,$hex,$alpha=50){
	$color=HexToRGB($hex);
	return imagecolorallocatealpha($im,$color['r'],$color['g'],$color['b'],$alpha);
}
function imagecreatefromany($imagen){
	if(!fileExistsRemote($imagen)){
		if(isset($_GET['debug'])) echo '<br/>No existe '.$imagen;
		return false;
	}
	$type=getimagesize($imagen);
	$type=$type[2];
	//$type:1=gif,2=jpg,3=png
	if($type==1) return imagecreatefromgif ($imagen);
	if($type==2) return imagecreatefromjpeg($imagen);
	if($type==3) return imagecreatefrompng ($imagen);
	//Retorna falso si no es ninguno de los tipos identificados
	return false;
}

function tagURL($tag,$mini=false){
	$tid=substr(intToMd5($tag),-16);
	return FILESERVER.'img/tags/'.$tid.($mini?'.m':'').'.jpg';
}

function createTag($tag,$force=false,$msg=false){
	//Informacion basica para crear la imagen de tag
	$default='tmp'.rand(0,99);
	$path='img/tags';
	$debug=isset($_GET['debug'])||(is_array($tag)&&$tag['debug']!='');
	$tid=substr(intToMd5(is_array($tag)?($tag['idTag']==''?$default:$tag['idTag']):$tag),-16);
	$tmpFile=$default;
	if($tid==$default){
		$force=true;
		$tid=$tmpFile;
	}
	$photo=$tid.'.jpg';
	$photom=$tid.'.m.jpg';
	$photopath=$path.'/'.$photo;
	$photompath=$path.'/'.$photom;
	$_path=LOCAL?RELPATH:FILESERVER;
	//Se busca la imagen de la tag
	if(!$force) $im=imagecreatefromany($_path.$photopath);
	//Si la imagen de la tag no existe,se crea
	if(!$im||$debug){
		if(!is_array($tag)) $tag=getTagData($tid);
		//Debugger
		if($debug){
			_imprimir($tag);
			echo '<br/>fondo='.(strpos(' '.$tag['fondoTag'],'default')?RELPATH:$_path).'img/templates/'.$tag['fondoTag'];
			echo '<br/>path='.$_path;
			echo '<br/>photo='.$tag['photoOwner'];
			echo '<br/>getUserPicture='.getUserPicture($tag['photoOwner']);
		}
		if($tag){
			$font=array(
				RELPATH.'fonts/trebuc.ttf',
				RELPATH.'fonts/trebucbd.ttf',
				RELPATH.'fonts/verdana.ttf',
				RELPATH.'fonts/verdanab.ttf'
			);
			//Se crea la imagen con el tamaño normal - 650 x 300.
			$im=imagecreatetruecolor(TAGWIDTH,TAGHEIGHT);
			//Crear algunos colores
			$blanco=imagecolorallocate($im,255,255,255);
			$negro=imagecolorallocate($im,0,0,0);
			//Fondo
			$imagen=(strpos(' '.$tag['fondoTag'],'default')?RELPATH:$_path).'img/templates/'.$tag['fondoTag'];
			$img=imagecreatefromany($imagen);
			if($img){
				$is=getimagesize($imagen);
				$dy=intval((TAGHEIGHT-$is[1])/2);
				while($dy>0) $dy-=$is[1];
				do{
					$dx=$is[0]>TAGWIDTH?intval((TAGWIDTH-$is[0])/2):0;
					do{
						imagecopy($im,$img,$dx,$dy,0,0,$is[0],$is[1]);
						$dx+=$is[0];
					}while($dx<TAGWIDTH);
					$dy+=$is[1];
				}while($dy<TAGHEIGHT);
				imagedestroy($img);
			}
			//Bordes redondeados
			$cr=25;//radio de la curva
			$ce=array(1,1,1,1);//esquinas a redondear. (si,sd,ii,id). (tl,tr,bl,br).
			$mask=imagecreatetruecolor($cr*2+1,$cr*2+1);
			imagealphablending($mask,false);
			//$maskcolor=imagecolorallocate($im,255,0,255);//color para remplazar por transparencia
			$maskcolor=imagecolorallocate($im,255,255,255);
			$transparent=imagecolorallocatealpha($im,0,0,0,127);
			imagefilledrectangle($mask,0,0,$cr*2+1,$cr*2+1,$maskcolor);
			imagefilledellipse($mask,$cr,$cr,$cr*2,$cr*2,$transparent);
			//Top-left corner-esquina superior izquierda
			if ($ce[0]){
				$cx=0;
				$cy=0;
				$dx=0;
				$dy=0;
				imagecopy($im,$mask,$dx,$dy,$cx,$cy,$cr,$cr);
			}
			//Top-right corner - esquina superior derecha
			if ($ce[1]){
				$cx=$cr+1;
				$cy=0;
				$dx=TAGWIDTH-$cr;
				$dy=0;
				imagecopy($im,$mask,$dx,$dy,$cx,$cy,$cr,$cr);
			}
			//Bottom-left corner - esquina inferior izquierda
			if ($ce[2]){
				$cx=0;
				$cy=$cr+1;
				$dx=0;
				$dy=TAGHEIGHT-$cr;
				imagecopy($im,$mask,$dx,$dy,$cx,$cy,$cr,$cr);
			}
			//Bottom-right corner - esquina inferior derecha
			if ($ce[3]){
				$cx=$cr+1;
				$cy=$cr+1;
				$dx=TAGWIDTH-$cr;
				$dy=TAGHEIGHT-$cr;
				imagecopy($im,$mask,$dx,$dy,$cx,$cy,$cr,$cr);
			}
			imagedestroy($mask);
			/*
			//Transparencia en las esquinas (solo para png)
			imagealphablending($im,false);
			imagesavealpha($im,true);
			$transparent=imagecolorallocatealpha($im,255,0,255,127);
			for($i=0;$i<TAGWIDTH;$i++)for($j=0;$j<TAGHEIGHT;$j++){
				$rgb=imagecolorat($im,$i,$j);
				if($rgb==16711935) imagesetpixel($im,$i,$j,$transparent);
			}
			imagealphablending($im,true);
			/**/
			//Imagen de placa
			$imagen=RELPATH.'img/placaFondo.png';
				$img=imagecreatefromany($imagen);
				if($img){
				$is=getimagesize($imagen);
				imagecopy($im,$img,0,0,0,0,$is[0],$is[1]);
				imagedestroy($img);
			}
			//Imagen de usuario
            if($tag['idProduct'])
                $imagen=$_path.$tag['photoOwner'];
            else
                $imagen=$_path.getUserPicture($tag['photoOwner'],'img/users/default.png');
			if($debug) echo '<br/>'.$imagen;
			$img=imagecreatefromany($imagen);
			if($img){
				$is=getimagesize($imagen);
				$x=40;
				$y=215;
				//imagefilledrectangle($im,$x-1,$y-1,$x+60,$y+60,$blanco);//marco
				imagecopyresampled($im,$img,$x,$y,0,0,60,60,$is[0],$is[1]);
				imagedestroy($img);
			}
			//Textos de la tag.
			//texto1 y texto2 por su tamaño se les define un ancho maximo y pueden tener multiples lineas
			$luz	=imagecolorhexallocatealpha($im,'#FFFFFF');
			$sombra	=imagecolorhexallocatealpha($im,'#000000');
			//Tipos de fuentes. 0=normal,1=negrita
			//texto1 - Parte superior
			$fuente=$font[1];
			$texto=strclean($tag['texto']);
			$color=imagecolorhexallocate($im,$tag['color_code']);
			$size=15;
			$txt=imagettfbbox($size,0,$fuente,$texto);
			$y=73;
			$mw=600;//max width - ancho maximo
			$tmp=explode(' ',$texto);
			$i=0;
			do{
				$texto=$tmp[$i++];
				$txt=imagettfbbox($size,0,$fuente,$texto);
				while(count($tmp)>$i&&$txt[2]<$mw){
					$txt=imagettfbbox($size,0,$fuente,$texto.' '.$tmp[$i]);
					if($txt[2]<$mw) $texto.=' '.$tmp[$i++];
				}
				$txt=imagettfbbox($size,0,$fuente,$texto);
				$x=intval((TAGWIDTH-$txt[2])/2);
				imagettftext($im,$size,0,$x+1,$y+1,$sombra,$fuente,$texto);
				imagettftext($im,$size,0,$x-1,$y-1,$luz,$fuente,$texto);
				imagettftext($im,$size,0,$x,$y,$color,$fuente,$texto);
				$y+=23;
			}while(count($tmp)>$i);
			//texto principal - Centro
			$fuente=$font[0];
			$texto=strtoupper(strclean($tag['code_number']));
			$color=imagecolorhexallocate($im,$tag['color_code2']);
			$size=45;
			$s=0;//separacion entre letras
			$len=strlen($texto);
			$txt=imagettfbbox($size,0,$fuente,$texto);
			$x=intval((TAGWIDTH-$txt[2])/2);
			$y=165;
			imagettftext($im,$size,0,$x+1,$y+1,$sombra,$fuente,$texto);
			imagettftext($im,$size,0,$x-1,$y-1,$luz,$fuente,$texto);
			imagettftext($im,$size,0,$x,$y,$color,$fuente,$texto);
			//nombre usuario
			$fuente=$font[1];
			$texto=strclean($tag['nameOwner']);
			$color=$blanco;
			$sombra=$negro;
			$size=15;
			$x=115;
			$y=223;
			imagettftext($im,$size,0,$x+1,$y+1,$sombra,$fuente,$texto);
			imagettftext($im,$size,0,$x,$y,$color,$fuente,$texto);
			//fecha
			$txt=imagettfbbox($size,0,$fuente,$texto);
			$fuente=$font[0];
			$texto=date('d-M-Y H:i',$tag['date']);
			$size=8;
			$x+=$txt[2]+10;
			imagettftext($im,$size,0,$x+1,$y+1,$sombra,$fuente,$texto);
			imagettftext($im,$size,0,$x,$y,$color,$fuente,$texto);

			//texto2 - parte baja
			$fuente=$font[1];
			$texto=strclean($tag['texto2']);
			$color=imagecolorhexallocate($im,$tag['color_code3']);
			$size=10;
			$x=115;
			$y=241;
			$mw=430;//max width-ancho maximo
			$tmp=explode(' ',$texto);
			$i=0;
			do{
				$texto=$tmp[$i++];
				$txt=imagettfbbox($size,0,$fuente,$texto);
				while(count($tmp)>$i&&$txt[2]<$mw){
					$txt=imagettfbbox($size,0,$fuente,$texto.' '.$tmp[$i]);
					if($txt[2]<$mw) $texto.=' '.$tmp[$i++];
				}
				imagettftext($im,$size,0,$x+1,$y+1,$sombra,$fuente,$texto);
				imagettftext($im,$size,0,$x-1,$y-1,$luz,$fuente,$texto);
				imagettftext($im,$size,0,$x,$y,$color,$fuente,$texto);
				$y+=15;
			}while(count($tmp)>$i);
		}
		//subir el archivo al servidor
		if(!$debug){//si estamos en debug no se guarda
			$phototmp=RELPATH.$path.'/tmp'.rand().'.png';
			imagepng($im,$phototmp);
			if (redimensionar($phototmp,RELPATH.$photopath,650)){
				@unlink($phototmp);
				uploadFTP($photo,'tags',RELPATH,1);
				if($msg) echo '<br/>guardada imagen '.$photo;
			}
		}
	}elseif($msg) echo '<br/>ya existe la imagen '.$photo;
	//FIN - creacion de la imagen de la tag
	//creamos la miniatura si no existe
	if(!fileExistsRemote($_path.$photompath)||$force){
		if(!$debug){//si estamos en debug no se guarda
			$phototmp=RELPATH.$path.'/'.$tmpFile.'.png';
			imagepng($im,$phototmp);
			if (redimensionar($phototmp,RELPATH.$photompath,200)){
				@unlink($phototmp);
				uploadFTP($photom,'tags',RELPATH,1);
				if($msg) echo '<br/>guardada miniatura '.$photom;
			}
		}
	}
	$GLOBALS['cn']->query('UPDATE `tags` SET `img` ="'.$tid.'" WHERE `id` ="'.$tag['id'].'";');
	return $tid;
}

function tagEditEmail($new,$old){
	if($old!=0){
		$query=$GLOBALS['cn']->query('
			SELECT
				u.id_tag_old AS idOld,
				u.id_tag_new AS idNew
			FROM tags_edit_email u
			WHERE u.id_tag_new="'.$old.'"
		');
		if(mysql_num_rows($query)>0){
			$data=mysql_fetch_assoc($query);
			$GLOBALS['cn']->query('INSERT INTO tags_edit_email SET
					id_tag_old="'.$data['idOld'].'",
					id_tag_new="'.$new.'"
			');
		}
	}
	if($old==0){
		 $GLOBALS['cn']->query('INSERT INTO tags_edit_email SET
				id_tag_old="'.$new.'",
				id_tag_new="'.$new.'"
		');
	}

}

function tagToMail($tag,$emails,$actionIcon,$pathMail='../../',$msj='',$share=false){
	$tags=$GLOBALS['cn']->query('
		SELECT
			u.screen_name AS nameUsr,
			(SELECT screen_name FROM users WHERE id=t.id_user) AS nameUsr2,
			md5(CONCAT(u.id,"_",u.email,"_",u.id)) AS code,
			u.profile_image_url	 AS photoUser,
			t.id AS idTag,
			t.id_user AS idUser,
			t.id_creator AS idCreator,
			t.code_number AS code_number,
			t.color_code AS color_code,
			t.color_code2 AS color_code2,
			t.color_code3 AS color_code3,
			t.text AS texto,
			t.text2 AS texto2,
			t.date AS fechaTag,
			t.background AS fondoTag,
			t.video_url AS video_url,
			u.email AS email,
			u.referee_number AS referee_number
		FROM tags t JOIN users u ON t.id_creator=u.id
		WHERE t.id="'.$tag.'"
	');
	$tag=mysql_fetch_assoc($tags);
	incHitsTag($tag['idTag']);		//incremento de hits a la tag que se recibe
	$mails=explode(',',$emails);	//destinatarios
	if (count($mails)>0){
		$correos="";
		foreach ($mails as $per){
			if ($per!=''){
				//verificar si es usuario de seemytag
				$query=$GLOBALS['cn']->query('
					SELECT
						u.id AS id,
						u.email AS email
					FROM users u
					WHERE u.email LIKE "'.$per.'" OR md5(u.id)="'.$per.'"
				');
				if (mysql_num_rows($query)>0){
					$emailUserSend=mysql_fetch_assoc($query);
					$per=$emailUserSend['email'];
				}
				$sendDataPublicity=$tag['idTag'];
				//echo '- '.$per.'<br>';
				//imagenes del email
				$backg=(strpos(' '.$tag['fondoTag'],'default')?DOMINIO:FILESERVER).'img/templates/'.$tag['fondoTag'];
				$placa=DOMINIO.'img/placaFondo.png';
				$imgTag=DOMINIO.'includes/tag.php?tag='.md5($tag['idTag']);
				$linkTag=DOMINIO.'#&tag='.$tag['idTag'].'&referee='.$_SESSION['ws-tags']['ws-user']['code'];
				$iconoSpon=DOMINIO.'/img/menu_users/publicidad.png';
				$foto_usuario=($tag['photoUser']!='')?(FILESERVER."img/users/".$tag['code']."/".$tag['photoUser']):(DOMINIO."img/users/default.jpg");
				$foto_remitente=FILESERVER.getUserPicture($_SESSION['ws-tags']['ws-user']['code'].'/'.$_SESSION['ws-tags']['ws-user']['photo'],'img/users/default.png');
				$actionIcon=DOMINIO.'/'.$actionIcon;
				//product tags
				if($product=isProductTag($tag['idTag'])){
					$foto_usuario=FILESERVER."img/products/".$product['picture'];
					$tag['nameUsr']=$product['name'];
				}
				if ($msj!=''){
					$trMsj='<tr><td><table align="center" style="width:100%;">'.$trMsj.'</table></td></tr>';
				}else{
					$trMsj='';
				}
				//datos de la tag
				$_texto1=($tag['texto']!='&nbsp')?$tag['texto']:'<br/>';
				$_texto2=(trim($tag['code_number'])!='&nbsp')?$tag['code_number']:'<br/>';
				$_texto3=(trim($tag['texto2'])!='&nbsp')?$tag['texto2']:'<br/>';
				//Cabecera del correo del usuario
				$query=$GLOBALS['cn']->query('
					SELECT
						CONCAT(u.name," ",u.last_name) AS name_user,
						u.username AS username,
						(SELECT a.name FROM countries a WHERE a.id=u.country) AS pais,
						u.followers_count AS followers,
						u.friends_count AS friends
					FROM users u
					WHERE u.id="'.$_SESSION['ws-tags']['ws-user']['id'].'"
				');
				$array=mysql_fetch_assoc($query);
				if (trim($array['username'])!=''){
					$external='<strong>'.USERS_BROWSERFRIENDSLABELEXTERNALPROFILE.":</strong>&nbsp;<span ><a style='color:#999999' href='".DOMINIO.$array['username']."' onFocus='this.blur();' target='_blank'>".DOMINIO.$array['username']."</a><br>";
				}else{
					$external='<strong>'.USERS_BROWSERFRIENDSLABELEXTERNALPROFILE.":</strong>&nbsp;".formatoCadena($_SESSION['ws-tags']['ws-user']['full_name']);
				}
				$pais='';
				if (trim($array[pais])!=''){
					$pais='<strong>'.USERS_BROWSERFRIENDSLABELCOUNTRY.":</strong>&nbsp;<span style='color:#999999'>".$array['pais']."</span><br/>";
				}
				//seleccion de etiquetas
				//$labelTag=MENUTAG_CTRSHAREMAILTITLE1;
				$labelTag=LABELTAGSPRIVATE;
				//cuerpo del email
				$body='
					<table align="center" width="650" border="0" cellpadding="0" cellspacing="0" style="font-family:Verdana,Geneva,sans-serif;font-size:12px;border-radius:7px;background:#fff;padding-top:25px;">
						<tr>
							<td>
								<table style="width:100%;">
									<tr>
										<td style="padding-left:5px;font-size:14px;text-align:left">
											<img src="'.$foto_remitente.'" border="0" width="60" height="60" style="border:3px solid #CCCCCC" alt="user">
										</td>
										<td width="569" style="padding-left:5px;padding-bottom:20px;font-size:12px;text-align:left;">
												<div>
													'.$external.'<br>
													'.($pais!=''?$pais.'<br>':'').'
													'.USERS_BROWSERFRIENDSLABELFRIENDS.'(<strong>'.$array['friends'].'</strong>),&nbsp;'.USERS_BROWSERFRIENDSLABELADMIRERS.'(<strong>'.$array['followers'].'</strong>)
												</div>
										</td>
										</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="color:#000;padding-left:5px;font-size:14px">
								<table style="width:100%;">
									<tr>
										<td style="width:20px;">
											<img src="'.$actionIcon.'" width="16" height="16" border="0" alt="user">
										</td>
										<td style="text-align:left;width:450px;">
											<strong>'.formatoCadena($_SESSION['ws-tags']['ws-user']['full_name']).'</strong>&nbsp;'.$labelTag.'
										</td>
										<td background="'.DOMINIO.'css/smt/email/yellowbutton_get_started2.png" style="width:140px;height:22px;display:inline-block;background-repeat:no-repeat;padding:10px 14px 5px 5px;">
											<a style="font-weight:bold;color:#2d2d2d;font-size:12px;text-decoration:none" href="'.$linkTag.'">'.MENUTAG_CTRSHAREMAILTITLE2.'</a>
										</td>
									</tr>
								</table>
							</td>
						</tr>

						'.$trMsj.'

						<tr>
							<td colspan="2">
								<br>
									<p><a href="'.$linkTag.'" target="_blank"><img src="'.$imgTag.'" alt="tagbum.com"></a></p>
								<br>
							</td>
						</tr>
						<tr>
							<td colspan="2" valign="top">
								<center><table style="width:100%;">
									<tr>
										<td colspan="2" valign="top" style="border-bottom:1px #f4f4f4 solid;border-top:1px #f4f4f4 solid;padding:8px 0px 0px 0px;">
											<img src="'.DOMINIO.'/css/smt/email/publicidad3.png" alt="tagbum.com">
											&nbsp;
											'.USERPUBLICITY_PAYMENT.'
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" style="padding:70px 0px 0px 0px;font-size:13px;text-align:center;height:70px;">
											'.PUBLICITYSPACETEXT.'
										</td>
									</tr>
								</table></center>
							</td>
						</tr>
							<tr>
								<td>
									<center><table>
										<tr>
											<td align="center" style="padding-left:5px;text-align:center;width:100%;">
												'.(isset($device)?'This tag have been sent using my '.$device:'').'<br>'.
												MENUTAG_CTRSHAREMAILTITLE3.':<a href="'.$linkTag.'">Tagbum.com</a>
											</td>
										</tr>
									</table></center>
								</td>
							</tr>
					</table>
				';
				//envio del correo
				if (sendMail(formatMail($body,'790'),'no-reply@seemytag.com',formatoCadena($_SESSION['ws-tags']['ws-user']['full_name']),formatoCadena($_SESSION['ws-tags']['ws-user']['full_name']).' '.$labelTag,$per,$pathMail)){
					$correos.="-&nbsp;".$per.".<br/>";
					//insert tabla verificacion
					if($share&&!existe("tags_share_mails","id_tag"," WHERE id_tag='".$tag['idTag']."' AND referee_number='".$_SESSION['ws-tags']['ws-user']['code']."' AND email_destiny='".$per."' ")){
						$insert=$GLOBALS['cn']->query("
							INSERT INTO tags_share_mails SET
								id_tag='".$_GET['tag']."',
								referee_number='".$_SESSION['ws-tags']['ws-user']['code']."',
								email_destiny='".$per."',
								view='0'
						");
					}
				}//end if envio de correo

			}//if per
		}//foreach
	}//if (count($mails)>0)
	if ($share){
		return $correos;
	}
}
function storeCarMail($car){
	$acumulado_pedido=array();
	$product=array();
//*********************************************** PREPARACION PARA LOS EMAILS ********************************************************************
	//VARIABLES NECESARIAS
	//arrays de banderas para comprovaciones por usuario
	$backgrounds=array();
	$productSC=array();
	//arrays que va a llevar los datos de cada vendedor
	$seller=array();
	//variables para crear de forma dinamica el sql para reutilizar los string
	$sql='SELECT
			u.id AS idUser,
			CONCAT(u.name," ",u.last_name) AS name_user,
			u.username AS username,
			u.home_phone,
			u.mobile_phone,
			u.work_phone,
			u.profile_image_url AS photo,
			md5(concat(u.id,\'_\',u.email,\'_\',u.id)) AS code,
			u.type,
			u.email AS email';
	$pais=' ,p.name AS pais,
			c.name AS ciudad,
			u.zip_code,
			u.address AS direccion';
	$join='INNER JOIN countries p ON p.id=u.country
			INNER JOIN cities c ON c.id=u.city';
	$where=' id IN (';
	$limit=0;
//*******************************************************************************************************************************************************

	foreach ($car as $carrito){
		if (!$carrito['order']){

			$product['id']=$carrito['id'];
			$product['Mid']=md5($carrito['id']);
			$product['id_user']=$carrito['seller'];
			$product['name']=$carrito['name'];
			$product['description']=$carrito['description'];
			$product['photo']=$carrito['photo'];
			$product['place']=$carrito['place'];
			$product['sale_points']=$carrito['sale_points'];
			$product['nameC']=$carrito['category'];
			$product['nameSC']=$carrito['subCategory'];
			$product['id_category']=$carrito['id_category'];
			$product['id_sub_category']=$carrito['id_sub_category'];
			$product['email_seller']=$carrito['email_seller'];
			$product['formPayment']=$carrito['formPayment'];
			$product['productFail']=$carrito['productFail'];
			$product['cant']=$carrito['cant'];
			$product['fail']=$carrito['fail'];

			$cant=$carrito['cant'];$productCost=0;
			if ($carrito['formPayment']!=1)
				$productCost=$product['sale_points']*$cant;

//****************************************************************************************************************************************************************

		//armado del arrays que posee todos los datos para la maquetacion del email
		//a diferencia del carrito el email se agrupa por vendedor por eso es necesario ordenar el array de dicha forma
			if (isset($acumulado_pedido[$product['id_user']])){
				$i=count($acumulado_pedido[$product['id_user']]['products']);
				$acumulado_pedido[$product['id_user']]['email_seller']=$product['email_seller'];
				$acumulado_pedido[$product['id_user']]['place']=$product['place'];
				$acumulado_pedido[$product['id_user']]['products'][$i]['id']=$product['id'];
				$acumulado_pedido[$product['id_user']]['products'][$i]['id_user']=$product['id_user'];
				$acumulado_pedido[$product['id_user']]['products'][$i]['name']=$product['name'];
				$acumulado_pedido[$product['id_user']]['products'][$i]['photo']=$product['photo'];
				$acumulado_pedido[$product['id_user']]['products'][$i]['place']=$product['place'];
				$acumulado_pedido[$product['id_user']]['products'][$i]['price2']=$product['sale_points'];
				$acumulado_pedido[$product['id_user']]['products'][$i]['price']=$product['formPayment']=='1'?number_format($product['sale_points'],2,'.',','):number_format($product['sale_points'],0,'',',');;
				$acumulado_pedido[$product['id_user']]['products'][$i]['nameCate']=$product['nameC'];
				$acumulado_pedido[$product['id_user']]['products'][$i]['nameSubCate']=$product['nameSC'];
				$acumulado_pedido[$product['id_user']]['products'][$i]['id_category']=$product['id_category'];
				$acumulado_pedido[$product['id_user']]['products'][$i]['id_sub_category']=$product['id_sub_category'];
                $acumulado_pedido[$product['id_user']]['products'][$i]['cant2']=$product['cant'];
                $acumulado_pedido[$product['id_user']]['products'][$i]['cant']=number_format($product['cant'],0,'',',');
				$acumulado_pedido[$product['id_user']]['products'][$i]['formPayment']=$product['formPayment'];
				if (!$backgrounds[$product['id_user']]&&($product['id_category']==1)) $backgrounds[$product['id_user']]=true;
				if (!$productSC[$product['id_user']]&&($product['id_category']!=1)) $productSC[$product['id_user']]=true;
			}else{
				$acumulado_pedido[$product['id_user']]['total_suma']=$productCost;
				$acumulado_pedido[$product['id_user']]['email_seller']=$product['email_seller'];
				$acumulado_pedido[$product['id_user']]['place']=$product['place'];
				$acumulado_pedido[$product['id_user']]['id_user']=$product['id_user'];
				$acumulado_pedido[$product['id_user']]['products'][0]['id']=$product['id'];
				$acumulado_pedido[$product['id_user']]['products'][0]['id_user']=$product['id_user'];
				$acumulado_pedido[$product['id_user']]['products'][0]['name']=$product['name'];
				$acumulado_pedido[$product['id_user']]['products'][0]['photo']=$product['photo'];
				$acumulado_pedido[$product['id_user']]['products'][0]['place']=$product['place'];
				$acumulado_pedido[$product['id_user']]['products'][0]['price2']=$product['sale_points'];
				$acumulado_pedido[$product['id_user']]['products'][0]['price']=$product['formPayment']=='1'?number_format($product['sale_points'],2,'.',','):number_format($product['sale_points'],0,'',',');
				$acumulado_pedido[$product['id_user']]['products'][0]['nameCate']=$product['nameC'];
				$acumulado_pedido[$product['id_user']]['products'][0]['nameSubCate']=$product['nameSC'];
				$acumulado_pedido[$product['id_user']]['products'][0]['id_category']=$product['id_category'];
				$acumulado_pedido[$product['id_user']]['products'][0]['id_sub_category']=$product['id_sub_category'];
				$acumulado_pedido[$product['id_user']]['products'][0]['cant2']=$product['cant'];
                $acumulado_pedido[$product['id_user']]['products'][0]['cant']=number_format($product['cant'],0,'',',');
                $acumulado_pedido[$product['id_user']]['products'][0]['formPayment']=$product['formPayment'];
				if (isset($product['fail'])) $failOrderStock[$product['id_user']]=true;
				$backgrounds[$product['id_user']]=($product['id_category']==1)?true:false;
				$productSC[$product['id_user']]=($product['id_category']!=1)?true:false;
				$where.=($where==' id IN (')?'"'.$product['id_user'].'"':',"'.$product['id_user'].'"';
				$limit++;
			}
		}
	}
	$where.=')';
//***************************************************COMIENZA EL EMAIL**********************************************************************************

	//consultas a la base de datos para obtener los datos del usuario comprador para los emails de los vendedores
	$query=$GLOBALS['cn']->query($sql.$pais.' FROM users u '.$join.' WHERE u.id="'.$car['order']['comprador'].'" LIMIT 0,1;');
	$array=mysql_fetch_assoc($query);

	//consultas a la base de datos para obtener los datos de los usuarios vendedores para el email del usuario comprador
	$query2=$GLOBALS['cn']->query($sql.' FROM users u WHERE '.$where.' LIMIT 0,'.$limit.';');
	//llenado del vector para tener libre acceso a los datos de los vendedores
	while ($array2=mysql_fetch_assoc($query2)){
		$seller[$array2['idUser']]['id']=$array2['idUser'];
		$seller[$array2['idUser']]['name_user']=$array2['name_user'];
		$seller[$array2['idUser']]['username']=$array2['username'];
		$seller[$array2['idUser']]['home_phone']=$array2['home_phone'];
		$seller[$array2['idUser']]['mobile_phone']=$array2['mobile_phone'];
		$seller[$array2['idUser']]['work_phone']=$array2['work_phone'];
		$seller[$array2['idUser']]['email']=$array2['email'];
		$seller[$array2['idUser']]['type']=$array2['type'];
		$seller[$array2['idUser']]['photo']=FILESERVER.getUserPicture($array2['code']."/".$array2['photo'],'img/users/default.png');;
	}

	//foto del usuario comprador
	$foto_remitente=FILESERVER. getUserPicture($array['code']."/".$array['photo']);

	if (trim($array['username'])!=''){
		$external=USERS_BROWSERFRIENDSLABELEXTERNALPROFILE.":&nbsp;<span ><a style='color:#999999' href='".DOMINIO.$array['username']."' onFocus='this.blur();' target='_blank'>".DOMINIO.$array['username']."</a><br>";
	}else{
		$external=formatoCadena($array['name_user']);
	}

	//cabecera del email para el comprador
	$emailComprador='<table align="center" width="650" border="0" cellpadding="0" cellspacing="0" style="font-family:Verdana,Geneva,sans-serif;font-size:12px;border-radius:7px;background:#fff;padding-top:25px;">
						<tr>
							<td style="height:30px;font-size:20px;color:#999;font-weight:bold;text-align:center;">'.STORE_PURCHASETITLENEW.' <br><br></td>
						</tr>';
	//variables necesarias para el email del comprador
	$bodyEmail='';$totalPuntosAcumulados=0;$totalDolaresAcumulados=0;
	foreach ($acumulado_pedido as $acumulado){

				//bodyEmail es el cuerpo del mensaje al comprador
				$bodyEmail.='<tr>
								<td style="height:30px;font-size:16px;color:#999;font-weight:bold;text-align:left;">'.SELLER.':&nbsp;'.formatoCadena($seller[$acumulado['id_user']]['name_user']).'</td>
							</tr>
							<table align="center" width="650" border="0" cellpadding="0" cellspacing="0" style="font-family:Verdana,Geneva,sans-serif;font-size:12px;background:#fff;padding-top:25px;">
									<tr>
										<td>
											<table style="width:100%;">
												<tr>
													<td style="padding-left:5px;font-size:14px;text-align:left">
														<img src="'.$seller[$acumulado['id_user']]['photo'].'" alt="user" border="0" width="60" height="60" style="border:3px solid #CCCCCC">
													</td>
													<td width="569" style="padding-left:5px;padding-bottom:20px;font-size:12px;text-align:left;">
														<div>';
															if($seller[$acumulado['id_user']]['type']=='0'){
																	$bodyEmail.='<strong>'.ADDRESSBOOK_LBLHOMEPHOME.': </strong>'.$seller[$acumulado['id_user']]['home_phone'].'<br>';
															 }
				$bodyEmail.='								<strong>'.EMAIL_SELLER.': </strong>'.$seller[$acumulado['id_user']]['email'].'<br>
															<strong>'.USERPROFILE_LBLMOBILEPHONE.': </strong>'.$seller[$acumulado['id_user']]['mobile_phone'].'<br>
															<strong>'.USERPROFILE_LBLWORKPHONE.': </strong>'.$seller[$acumulado['id_user']]['work_phone'].'</br>
														</div>
													</td>
												 </tr>
											</table>
										</td>
									</tr>';

				//emaelSeller es el cuerpo de los mensajes de cada vendedor
				$emailSeller='<table align="center" width="650" border="0" cellpadding="0" cellspacing="0" style="font-family:Verdana,Geneva,sans-serif;font-size:12px;border-radius:7px;background:#fff;padding-top:25px;">
									<tr>
										<td style="height:30px;font-size:24px;color:#999;font-weight:bold;text-align:center;"><strong>'.formatoCadena($array['name_user']).'&nbsp;'.STORE_EMAILSELLER.'</strong><br><br></td>
									</tr>
									<tr>
										<td>
											<table style="width:100%;">
												<tr>
													<td style="padding-left:5px;font-size:14px;text-align:left">
														<img src="'.$foto_remitente.'" alt="user" border="0" width="60" height="60" style="border:3px solid #CCCCCC">
													</td>
													<td width="569" style="padding-left:5px;padding-bottom:20px;font-size:12px;text-align:left;">
														<div>
															<strong>'.formatoCadena($external).'</strong><br>';
															if($array['type']=='0'){
																		$emailSeller.='<strong>'.ADDRESSBOOK_LBLHOMEPHOME.':</strong>'.formatoCadena($array['home_phone']).'<br>';
															 }
				$emailSeller.='											<strong>'.SIGNUP_LBLEMAIL.': </strong>'.$array['email'].'<br>
														</div>
													</td>
												 </tr>
											</table>
										</td>
									</tr>
									<tr>
										<td style="height:30px;font-size:16px;color:#999;font-weight:bold;text-align:left;">'.STORE_SHIPPING.'</td>
									</tr>
									<tr>
										<td>
											<table style="width:100%;">
												<tr>
													<td style="width:120px;"><strong>'.BUSINESSCARD_LBLCOUNTRY.':</strong></td>
													<td style="text-align:left;">'.formatoCadena($array['pais']).'</td>
												</tr>
												<tr>
													<td style="width:120px;"><strong>'.BUSINESSCARD_LBLCITY.':</strong></td>
													<td style="text-align:left;">'.formatoCadena($array['ciudad']).'</td>
												</tr>
												<tr>
													<td style="width:120px;"><strong>'.BUSINESSCARD_LBLADDRESS.':</strong></td>
													<td style="text-align:left;">'.formatoCadena($array['direccion']).'</td>
												</tr>
												<tr>
													<td style="width:120px;"><strong>'.SIGNUP_ZIPCODE.':</strong></td>
													<td style="text-align:left;">'.$array['zip_code'].'</td>
												</tr>
												<tr>
													<td style="width:120px;"><strong>'.USERPROFILE_LBLMOBILEPHONE.':</strong></td>
													<td style="text-align:left;">'.$array['mobile_phone'].'</td>
												</tr>
												<tr>
													<td style="width:120px;"><strong>'.USERPROFILE_LBLWORKPHONE.':</strong></td>
													<td style="text-align:left;">'.$array['work_phone'].'</td>
												</tr>

											</table>
										</td>
									</tr>';
				if (isset($failOrderStock[$acumulado['id_user']])){
					$bodyEmail.='	<tr style="text-align:center;color:#AD3838;">
										<td style="padding:5px;">'.STORE_MAIL_ORDER_FAIL.'</td>
									</tr>';
				}
				//si la venta o la compra fueron unos fondos
				if ($backgrounds[$acumulado['id_user']]){
				 $bodyEmailP='<tr>
									<td style="height:30px;font-size:16px;color:#999;font-weight:bold;text-align:left;">'.NEWTAG_LBLBACKGROUNDS.' <br><br></td>
								</tr>
								<tr>
									<td><center>
										<table>
											<tr style="text-align:center">
												<td style="padding:5px;border-bottom:1px solid #F4F4F4;font-weight:bold;color:#AD3838;">'.STORE_DETPRDDETAIL.'</td>
												<td style="padding:5px;border-bottom:1px solid #F4F4F4;"></td>
											</tr>';
								$totalPoints=0;$totalDollars=0;
								$bodyEmail.=$bodyEmailP;
								$emailSeller.=$bodyEmailP;
								foreach ($acumulado['products'] as $ordenDetalles){
									if ($ordenDetalles['id_category']==1){

									if ($ordenDetalles['formPayment']==1){
										$totalDollars=$totalDollars+($ordenDetalles['price2']*$ordenDetalles['cant']);
										$totalDolaresAcumulados=$totalDolaresAcumulados+($ordenDetalles['price2']*$ordenDetalles['cant2']);
									}else{
										$totalPoints=$totalPoints+($ordenDetalles['price2']*$ordenDetalles['cant']);
										$totalPuntosAcumulados=$totalPuntosAcumulados+($ordenDetalles['price2']*$ordenDetalles['cant2']);
									}

									 $bodyEmail.='<tr style="text-align:center">
														<td style="padding:5px;border-bottom:1px solid #F4F4F4;border-right:1px solid #F4F4F4;">
														<img src="'.FILESERVER.'img/'.$ordenDetalles['photo'].'" alt="product" style="width:60px;height:60px;" /></td>
														<td style="border-bottom:1px solid #F4F4F4;border-right:1px solid #F4F4F4;text-align:left;width:400px;">
															<strong>'.formatoCadena($ordenDetalles['name']).'</strong><br>
															'.STORE_CATEGORIES2.':'.formatoCadena($ordenDetalles['nameCate']).'
															<br><span style="color:#AD3838;">'.(($ordenDetalles['formPayment']==1)?'$'.$ordenDetalles['price']:$ordenDetalles['price'].' '.STORE_TITLEPOINTS).'</span>&nbsp;&nbsp;'.QUANTITYSTORE.':'.$ordenDetalles['cant'].'
														</td>
													</tr>';
									 $emailSeller.='<tr style="text-align:center">
														<td style="padding:5px;border-bottom:1px solid #F4F4F4;border-right:1px solid #F4F4F4;">
														<img src="'.FILESERVER.'img/'.$ordenDetalles['photo'].'" alt="product" style="width:60px;height:60px;" /></td>
														<td style="border-bottom:1px solid #F4F4F4;border-right:1px solid #F4F4F4;text-align:left;width:400px;">
															<strong>'.formatoCadena($ordenDetalles['name']).'</strong><br>
															'.STORE_CATEGORIES2.': '.formatoCadena($ordenDetalles['nameCate']).'
															<br><span style="color:#AD3838;">'.(($ordenDetalles['formPayment']==1)?'$'.$ordenDetalles['price']:$ordenDetalles['price'].' '.STORE_TITLEPOINTS).'</span>&nbsp;&nbsp;'.QUANTITYSTORE.': '.$ordenDetalles['cant'].'
														</td>
													</tr>';


									}
								}
								$bodyEmailP='<tr style="text-align:center">
									<td style="padding:5px;border-bottom:1px solid #F4F4F4;font-weight:bold;color:black;">'.SUBTOTAL.'</td>
									<td style="padding:5px;border-bottom:1px solid #F4F4F4;"></td>
								</tr>';
								if ($totalPoints>0){
								$bodyEmailP.='<tr style="text-align:center">
									<td style="padding:5px;border-bottom:1px solid #F4F4F4;font-weight:bold;color:#AD3838;"><span style="margin-left:20px;">'.STORE_TITLEPOINTS.'</span></td>
									<td style="padding:5px;border-bottom:1px solid #F4F4F4;">'.number_format($totalPoints,0,'',',').'</td>
								</tr>';
								}
								if ($totalDollars>0){
								$bodyEmailP.='<tr style="text-align:center">
									<td style="padding:5px;border-bottom:1px solid #F4F4F4;font-weight:bold;color:#AD3838;"><span style="margin-left:20px;">'.TYPEPRICEMONEY.'</span></td>
									<td style="padding:5px;border-bottom:1px solid #F4F4F4;">$'.number_format($totalDollars,2,'.',',').'</td>
								</tr>';
								}
							$bodyEmailP.='</table></center>
						</td>
					</tr>';
					$bodyEmail.=$bodyEmailP;
					$emailSeller.=$bodyEmailP;
				}
				//si la compra o venta fueron unos productos
				if ($productSC[$acumulado['id_user']]){
					$bodyEmailP=' <tr>
										<td style="height:30px;font-size:16px;color:#999;font-weight:bold;text-align:left;">'.PRODUCT_TITLE.' <br><br></td>
									</tr>
									<tr>
										<td>
											<center>
												<table>
													<tr style="text-align:center">
														<td style="padding:5px;border-bottom:1px solid #F4F4F4;font-weight:bold;color:#AD3838;">'.STORE_DETPRDDETAIL.'</td>
														<td style="padding:5px;border-bottom:1px solid #F4F4F4;"></td>
													</tr>';
									$totalPoints=0;$totalDollars=0;
									$bodyEmail.=$bodyEmailP;
									$emailSeller.=$bodyEmailP;
									foreach ($acumulado['products'] as $ordenDetalles){
										if ($ordenDetalles['id_category']!=1){

											if ($ordenDetalles['formPayment']==1){
												$totalDollars=$totalDollars+($ordenDetalles['price2']*$ordenDetalles['cant2']);
												$totalDolaresAcumulados=$totalDolaresAcumulados+($ordenDetalles['price2']*$ordenDetalles['cant2']);
											}else{
												$totalPoints=$totalPoints+($ordenDetalles['price2']*$ordenDetalles['cant']);
												$totalPuntosAcumulados=$totalPuntosAcumulados+($ordenDetalles['price2']*$ordenDetalles['cant2']);
											}
											$bodyEmail.=' <tr style="text-align:center">
																<td style="padding:5px;border-bottom:1px solid #F4F4F4;border-right:1px solid #F4F4F4;">
																<img src="'.FILESERVER.'img/'.$ordenDetalles['photo'].'" alt="product" style="width:60px;height:60px;" /></td>
																<td style="border-bottom:1px solid #F4F4F4;border-right:1px solid #F4F4F4;text-align:left;width:400px;">
																	<strong>'.formatoCadena($ordenDetalles['name']).'</strong><br>
																	'.STORE_CATEGORIES2.': '.formatoCadena($ordenDetalles['nameCate']).' '.STORE_CATEGORIES3.': '.formatoCadena($ordenDetalles['nameSubCate']).'
																	<br><span style="color:#AD3838;">'.(($ordenDetalles['formPayment']==1)?'$'.$ordenDetalles['price']:$ordenDetalles['price'].' '.STORE_TITLEPOINTS).'</span>&nbsp;&nbsp;'.QUANTITYSTORE.': '.$ordenDetalles['cant'].'
																</td>
															</tr>';
											$emailSeller.=' <tr style="text-align:center">
																<td style="padding:5px;border-bottom:1px solid #F4F4F4;border-right:1px solid #F4F4F4;">
																<img src="'.FILESERVER.'img/'.$ordenDetalles['photo'].'" alt="product" style="width:60px;height:60px;" /></td>
																<td style="border-bottom:1px solid #F4F4F4;border-right:1px solid #F4F4F4;text-align:left;width:400px;">
																	<strong>'.formatoCadena($ordenDetalles['name']).'</strong><br>
																	'.STORE_CATEGORIES2.': '.formatoCadena($ordenDetalles['nameCate']).' '.STORE_CATEGORIES3.': '.formatoCadena($ordenDetalles['nameSubCate']).'
																	<br><span style="color:#AD3838;">'.(($ordenDetalles['formPayment']==1)?'$'.$ordenDetalles['price']:$ordenDetalles['price'].' '.STORE_TITLEPOINTS).'</span>&nbsp;&nbsp;'.QUANTITYSTORE.': '.$ordenDetalles['cant'].'
																</td>
															</tr>';
										}
									}
									$bodyEmailP=' <tr style="text-align:center">
														<td style="padding:5px;border-bottom:1px solid #F4F4F4;font-weight:bold;color:black">'.SUBTOTAL.'</td>
														<td style="padding:5px;border-bottom:1px solid #F4F4F4;"></td>
													</tr>';
									if($totalPoints>0){
									$bodyEmailP.='	<tr style="text-align:center">
														<td style="padding:5px;border-bottom:1px solid #F4F4F4;font-weight:bold;color:#AD3838;"><span style="margin-left:20px;">'.STORE_TITLEPOINTS.'</span></td>
														<td style="padding:5px;border-bottom:1px solid #F4F4F4;">'.number_format($totalPoints,0,'',',').'</td>
													</tr>';
									}
									if($totalDollars>0){
									$bodyEmailP.='	<tr style="text-align:center">
														<td style="padding:5px;border-bottom:1px solid #F4F4F4;font-weight:bold;color:#AD3838;"><span style="margin-left:20px;">'.TYPEPRICEMONEY.'</span></td>
														<td style="padding:5px;border-bottom:1px solid #F4F4F4;">$'.number_format($totalDollars,2,'.',',').'</td>
													</tr>';
									}
									$bodyEmailP.='</table>
											</center>
										</td>
									</tr>';
					$bodyEmail.=$bodyEmailP;
					$emailSeller.=$bodyEmailP;
				}
				$emailSeller.='</table>';

				//envio del email a los vendedores...
				if(sendMail(formatMail($emailSeller,'790'),'no-reply@seemytag.com',formatoCadena($array['name_user']),$array['name_user'].' '.STORE_EMAILMESSAGE,$acumulado['email_seller'],'../../'))
					$emailSend='1';
				else
					$emailSend='0';
		}
		//unir la cabecera con el cuerpo del email de comprador
		$emailComprador.=$bodyEmail;
		//terminar el email del comprador
		$emailComprador.=' <tr style="text-align:left">
								<td style="padding:5px;font-weight:bold;color:black;">'.TOTAL.' '.STORE_ORDER.'</td>
							</tr>';
		if ($totalPuntosAcumulados>0){
		$emailComprador.='	<tr style="text-align:left">
								<td style="padding:5px;"><span style="font-weight:bold;color:black;margin-left:20px;">'.STORE_TITLEPOINTS.': </span> '.number_format($totalPuntosAcumulados,0,'',',').'</td>
							</tr>';
		}
		if ($totalDolaresAcumulados>0){
		$emailComprador.='	<tr style="text-align:left">
								<td style="padding:5px;"><span style="font-weight:bold;color:black;margin-left:20px;">'.TYPEPRICEMONEY.': </span>$'.number_format($totalDolaresAcumulados,2,'.',',').'</td>
							</tr>';
		}
		$emailComprador.='</table>';
		if(sendMail(formatMail($emailComprador,'790'),'no-reply@seemytag.com','Tagbum.com',STORE_PURCHASETITLENEW,$array['email'],'../../'))
			$emailSend='1';
		else
			$emailSend='0';
//fin del envio del correo electronico
//*************************************************************************************************************************************
}

function strToLink($string){
	$pattern=regex('url');//'/((https?:\/\/)?[a-zA-Z]\w*([\.\-\w]+)?\.([a-z]{2,4}|travel)(:\d{2,5})?(\/.*)?)/';
	$replacement='<a href="${1}" target="_blank">${1}</a>';
	return preg_replace($pattern,$replacement,$string);
}

function get_hashtags($tweet){
	preg_match_all('/#\S+/i',$tweet,$matches);
	return $matches[0];
}
function generaCodeId($id,$length,$caracter='0'){
	$cadena='';$num=strlen($id);
	if ($num>$length) return false;
	for($i=0;$i<($length-$num);$i++){
		$cadena.=$caracter;
	}
	return '#'.$cadena.$id;
}
function intToMd5($id){
	if(is_string($id)) $id=trim($id);
	if($id!=''&&!preg_match('/\D/',$id)) $id=md5($id);
	return $id;
}

function validPointPubli($idUser,$idPubli,$ip){
	$sql = "
		SELECT * , IF( TIMEDIFF( NOW( ) , timep ) >  '24:00:00', 1, 0 ) AS acceso
		FROM users_publicity_validation
		WHERE id_user =  '".$idUser."'
		AND md5(id_publicity) =  '".$idPubli."'
		AND ip =  '".$ip."'
		ORDER BY id DESC
		LIMIT 1";
	$valida  = $GLOBALS['cn']->query($sql);
//	echo $sql.'<br>';
	$pvalida = mysql_fetch_assoc($valida);
	$pvalidaN = mysql_num_rows($valida);
//	echo $pvalidaN;
//	echo $pvalida[id] .' acc: '.$pvalida[acceso].'<br>';
	if($pvalidaN==0||$pvalida['acceso']=='1'){
		$publi	= $GLOBALS['cn']->query("SELECT * FROM users_publicity WHERE md5(id) = '".$idPubli."'");
		$idp	= mysql_fetch_assoc($publi);
		$GLOBALS['cn']->query("
			INSERT INTO users_publicity_validation SET
				id_user			= '".$idUser."',
				id_publicity	= '".$idp['id']."',
				ip				= '".$ip."'
		 ");
		echo $pvalida['acceso'].' : '.mysql_insert_id();
	}else{
		echo $pvalida['acceso'];
	}
}

function tour_json($where=''){
	$notIn = ($_SESSION['ws-tags']['ws-user']['type']==0)?'AND u.id_div not in("#tourPublicity")':'';
	$hashtour = $GLOBALS['cn']->query('
		SELECT
			u.id_div AS id_div,
			u.title AS title,
			u.message AS message,
			u.position AS position,
			u.hash_tash AS hash_tash
		FROM tour_comment u
		WHERE md5(u.hash_tash) = "'.$where.'" AND active=1 AND sectionActive=1 '.$notIn.'
		ORDER BY u.orderP ASC
	');
	return $hashtour;
}

function tourHash_json($hashtash){
	$tourHash = $GLOBALS['cn']->query('
		SELECT
			u.id_user AS id_user,
			u.hash_tash AS hash_tash
		FROM tour_hash u
		WHERE u.id_user = "'.$_SESSION['ws-tags']['ws-user']['id'].'" AND u.hash_tash = "'.$hashtash.'"
	');
	$Hashtour = mysql_fetch_array($tourHash);
	if ($Hashtour[hash_tash]!=$hashtash){
		$GLOBALS['cn']->query('
			INSERT INTO tour_hash SET
				id_user = "'.$_SESSION['ws-tags']['ws-user']['id'].'",
				hash_tash = "'.$hashtash.'"
		');
		return '0';//registra el usuario y el hash
	}else{
		return '1';//ya ese hash y usuario se registro
	}
}
?>
