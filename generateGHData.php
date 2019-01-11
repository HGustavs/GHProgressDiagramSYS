<html>
	<head>
		<title>Generate GHData</title>
    <style>
				table {
				    border-collapse: collapse;
				}
				
				table, th, td {
				    border: 1px solid black;
				    vertical-align: top;
				    padding-left:6px;
				}
		</style>	
	</head>
<body>
<table>
<?php 
/*
Configuration
*/
date_default_timezone_set('Europe/Berlin' );
define("BASE_FOLDER","../githubdata/");
define("DATA_FOLDER","OSSPaper2019/");
/*
* 
* ----------===========--------------
*
*/
$process="ALL"; // ALL, ISSUES, GIT, BLAME
$dbFile="GHdata.db";
$newGitCommitFile="data_commits.js";
$newIssueFile="data_issues.js";
$gittags=array(2014=>"v0.4",2015=>"v0.7",2016=>"v0.85",2017=>"v0.95",2018=>"v0.105");
$oldcommitsfiles=array("data_commits_Old.js");

if (!file_exists(BASE_FOLDER)) {
  echo "The directory ".BASE_FOLDER." does not exist or is inaccessable!";
  exit;
}else{
  chdir(BASE_FOLDER);
}

if(!file_exists(DATA_FOLDER)){
  echo "The directory ".DATA_FOLDER." does not exist or is inaccessable!";
  exit;
}else{
  chdir(DATA_FOLDER);
}

if(file_exists($dbFile)){
  echo "The database file ".$dbFile." already exist! Please remove to regenerate the database.";
  exit;
}

$log_db = new PDO('sqlite:'.$dbFile);
$sql= 'CREATE TABLE IF NOT EXISTS commitgit(id INTEGER PRIMARY KEY,cid VARCHAR(40),p1id VARCHAR(40),p2id VARCHAR(40),author VARCHAR(32),authornme VARCHAR(32),thedate TIMESTAMP,p1start INTEGER,p1end INTEGER,p2start INTEGER,p2end INTEGER, space INTEGER, thetime TIMESTAMP, thetimed INTEGER, thetimeh INTEGER,message TEXT);';
//$log_db->exec($sql);

$sql.= 'CREATE TABLE IF NOT EXISTS commitgit(id INTEGER PRIMARY KEY,cid VARCHAR(40),p1id VARCHAR(40),p2id VARCHAR(40),author VARCHAR(32),authornme VARCHAR(32),thedate TIMESTAMP,p1start INTEGER,p1end INTEGER,p2start INTEGER,p2end INTEGER, space INTEGER, thetime TIMESTAMP, thetimed INTEGER, thetimeh INTEGER,message TEXT);';
//$log_db->exec($sql);

$sql.= 'CREATE TABLE IF NOT EXISTS Bfile (id INTEGER PRIMARY KEY, purl TEXT, path TEXT, filename VARCHAR(256), filesize REAL, filelines INTEGER, harvestdate TIMESTAMP, gittag VARCHAR(16), courseyear VARCHAR(8));';
//$log_db->exec($sql);

$sql.= 'CREATE TABLE IF NOT EXISTS Blame (id INTEGER PRIMARY KEY, blamedate TIMESTAMP, blameuser VARCHAR(32), href VARCHAR(64),mess TEXT, rowcnt INTEGER, fileid INTEGER, gittag VARCHAR(16), courseyear VARCHAR(8));';
//$log_db->exec($sql);

$sql.= 'CREATE TABLE IF NOT EXISTS CodeRow(id INTEGER PRIMARY KEY, fileid INTEGER, blameid INTEGER, blameuser VARCHAR(32), rowno INTEGER, code TEXT, gittag VARCHAR(16), courseyear VARCHAR(8));';
//$log_db->exec($sql);

$sql.= 'CREATE TABLE IF NOT EXISTS issue (id INTEGER PRIMARY KEY,issueno VARCHAR(8), issuetime TIMESTAMP, issuetimed INTEGER, issuetimeh INTEGER, author VARCHAR(32), state VARCHAR(32), title TEXT, message TEXT);';
//$log_db->exec($sql);

$sql.= 'CREATE TABLE IF NOT EXISTS event (id INTEGER PRIMARY KEY,issueno VARCHAR(8), eventtime TIMESTAMP,eventtimed INTEGER, eventtimeh INTEGER, author VARCHAR(32), kind VARCHAR(32), content TEXT, aux TEXT);';
//$log_db->exec($sql);

$sql.= 'CREATE TABLE IF NOT EXISTS commitdata (id INTEGER PRIMARY KEY,issueno VARCHAR(8), commentno INTEGER, eventno INTEGER, author VARCHAR(32), content TEXT);';
//$log_db->exec($sql);

$sql.= 'CREATE TABLE IF NOT EXISTS stud (id INTEGER PRIMARY KEY,fornamn VARCHAR(32),efternamn VARCHAR(32),sex VARCHAR(2), anmkod INTEGER, program VARCHAR(8), termin VARCHAR(4),ar VARCHAR(4), kurskod VARCHAR(8), kursnamn varchar(64), poang INTEGER,grupp INTEGER,rol VARCHAR(4),roletime INTEGER,author VARCHAR(32));';
$log_db->exec($sql);


if($process==="ALL"||$process==="GIT"){
  foreach($oldcommitsfiles as $oldcommitsfile){
    $foo=file_get_contents($oldcommitsfile);
    $arr=json_decode($foo);
        
    // For every issue
    foreach($arr as $key => $commit){
    
        $p1ID="UNK";
        $p2ID="UNK";
        $p1Start="UNK";
        $p2Start="UNK";
        $p1End="UNK";
        $p2End="UNK";
        
        // Commit or merge
        if(isset($commit->parents[0])){
            if(isset($commit->parents[1])){
                $p2ID=$commit->parents[1][0];
                $p2Start=$commit->parents[1][1];;
                $p2End=$commit->parents[1][2];;
            }
            $p1ID=$commit->parents[0][0];
            $p1Start=$commit->parents[0][1];;
            $p1End=$commit->parents[0][2];;
        }
        $author=$commit->author;
        $login=$commit->login;
        $date=$commit->date;
        $space=$commit->space;
        
        $time=$commit->time;
        $date1=date_create($commit->date);						
        $date2=date_create("2014-01-01");
        $interval=date_diff($date1,$date2);
        $intervald=$interval->format("%a");
        $intervalh=$interval->format("%h");
        
        
        $id=$commit->id;
        $message=$commit->message;
        
        $query = $log_db->prepare('INSERT INTO commitgit(cid,p1id,p2id,p1start,p2start,p1end,p2end,space,thetime,thetimed,thetimeh,thedate,author,authornme,message) VALUES (:cid,:p1id,:p2id,:p1start,:p2start,:p1end,:p2end,:space,:thetime,:thetimed,:thetimeh,:thedate,:author,:authornme,:message);');        
        $query->bindParam(':cid', $id);
        $query->bindParam(':p1id', $p1ID);
        $query->bindParam(':p2id', $p2ID);
        $query->bindParam(':p1start', $p1Start);
        $query->bindParam(':p2start', $p2Start);
        $query->bindParam(':p1end', $p1End);
        $query->bindParam(':p2end', $p2End);
    
        $query->bindParam(':space', $space);
        $query->bindParam(':thetime', $time);
        $query->bindParam(':thetimed', $intervald);
        $query->bindParam(':thetimeh', $intervalh);
    
        $query->bindParam(':thedate', $date);
        
        $query->bindParam(':authornme', $author);
        $query->bindParam(':message', $message);
        $query->bindParam(':author', $login);
    
        $query->execute();
    
    }  
  }
  
  $foo=file_get_contents($newGitCommitFile);
  $arr=json_decode($foo);
    
  // For every issue
  foreach($arr as $key => $commit){
        
      $p1ID="UNK";
      $p2ID="UNK";
      $p1Start="UNK";
      $p2Start="UNK";
      $p1End="UNK";
      $p2End="UNK";
      
      // Commit or merge
      if(isset($commit->parents[0])){
          if(isset($commit->parents[1])){
              $p2ID=$commit->parents[1][0];
              $p2Start=$commit->parents[1][1];;
              $p2End=$commit->parents[1][2];;
          }
          $p1ID=$commit->parents[0][0];
          $p1Start=$commit->parents[0][1];;
          $p1End=$commit->parents[0][2];;
      }
      $author=$commit->author;
      $login=$commit->login;
      $date=$commit->date;
      $space=$commit->space;
      
      $time=$commit->time;
      $date1=date_create($commit->date);						
      $date2=date_create("2014-01-01");
      $interval=date_diff($date1,$date2);
      $intervald=$interval->format("%a");
      $intervalh=$interval->format("%h");
      
      
      $id=$commit->id;
      $message=$commit->message;
      
      $query = $log_db->prepare('INSERT INTO commitgit(cid,p1id,p2id,p1start,p2start,p1end,p2end,space,thetime,thetimed,thetimeh,thedate,author,authornme,message) VALUES (:cid,:p1id,:p2id,:p1start,:p2start,:p1end,:p2end,:space,:thetime,:thetimed,:thetimeh,:thedate,:author,:authornme,:message);');
  
      $p1Start+=2733;
      if($p2Start!="UNK") $p2Start+=2733;
      $time+=2733;
    
      $query->bindParam(':cid', $id);
      $query->bindParam(':p1id', $p1ID);
      $query->bindParam(':p2id', $p2ID);
      $query->bindParam(':p1start', $p1Start);
      $query->bindParam(':p2start', $p2Start);
      $query->bindParam(':p1end', $p1End);
      $query->bindParam(':p2end', $p2End);
  
      $query->bindParam(':space', $space);
      $query->bindParam(':thetime', $time);
      $query->bindParam(':thetimed', $intervald);
      $query->bindParam(':thetimeh', $intervalh);
  
      $query->bindParam(':thedate', $date);
      
      $query->bindParam(':authornme', $author);
      $query->bindParam(':message', $message);
      $query->bindParam(':author', $login);
  
      echo "<tr>";
      echo "<td>".$p1Start."</td>";
      echo "<td>".$p2Start."</td>";
      echo "<td>".$time."</td>";
      echo "</tr>";
  
      ob_flush();
      flush();
      $query->execute();
  
  }
  
}
	
?> 

</table>
<table>
<?php 
if($process==="ALL"||$process==="ISSUES"){
  $foo=file_get_contents($newIssueFile);
  $foo=substr($foo, 1);
  $foo="[".$foo."]";
  
  $arr=json_decode($foo);	
    
  // For every issue
  foreach($arr as $key => $issue){
    
      echo "<pre>";
      echo $issue->issueno."     ".$issue->issuetitle."\n";
  
      $query = $log_db->prepare('INSERT INTO issue(issueno,issuetime,issuetimed, issuetimeh, author, state, title, message) VALUES (:issueno,:issuetime,:issuetimed,:issuetimeh,:author,:state,:title,:message)');
  
      if($issue->time!="undefined"){
          $date1=date_create($issue->time);						
      }else{
          $date1=date_create("2014-01-01");;												
      }
      $date2=date_create("2014-01-01");
      $interval=date_diff($date1,$date2);
      $intervald=$interval->format("%a");
      $intervalh=$interval->format("%h");
          
      $query->bindParam(':issueno', $issue->issueno);
      $query->bindParam(':issuetime', $issue->time);
      $query->bindParam(':author', $issue->issueauthor);
      $query->bindParam(':state', $issue->state);
      $query->bindParam(':title', $issue->issuetitle);
      $query->bindParam(':message', $issue->message);
      $query->bindParam(':issuetimeh', $intervalh);
      $query->bindParam(':issuetimed', $intervald);
      $query->execute();
      
  //		print_r($issue);
    
  //		print_r($issue->events);
    
      foreach($issue->events as $ekey => $event){
  
          if($event->time!="undefined"){
              $date1=date_create($event->time);						
          }else{
              $date1=date_create("2014-01-01");;												
          }
          $date2=date_create("2014-01-01");
  
          $interval=date_diff($date1,$date2);
          $intervald=$interval->format("%a");
          $intervalh=$interval->format("%h");
  
          $kind=$event->kind;
  
          $content="UNK";
        
          $aux="UNK";
  
          $query = $log_db->prepare('INSERT INTO event(issueno, author, content,eventtime,eventtimed,eventtimeh,kind,aux) VALUES (:issueno,:author,:content,:eventtime,:eventtimed,:eventtimeh,:kind,:aux)');
          $query->bindParam(':issueno', $issue->issueno);
          $query->bindParam(':eventtime', $event->time);
          $query->bindParam(':eventtimed', $intervald);
          $query->bindParam(':eventtimeh', $intervalh);
          $query->bindParam(':author', $event->eventauthor);
          $query->bindParam(':kind', $event->kind);
          $query->bindParam(':content', $event->text);
          $query->bindParam(':aux', $aux);			
          $query->execute();
        
          // echo $issue->issueno."\n".$event->time."\n".$intervald."\n".$event->eventauthor."\n".$event->text."\n".$content;
  
  
      }
          
  }
}  

?> 

</table>
<table style="">

<?php 
if($process==="ALL"||$process==="BLAME"){

  //$log_db = new PDO('sqlite:'.$dbFile);
  //$log_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "<tr>";
  echo "<td>url</td>";
  echo "<td>path</td>";
  echo "<td>filename</td>";
  echo "<td># lines</td>";
  echo "<td>size</td>";
  echo "<td>scrape date</td>";
  echo "<td>file pos</td>";
  echo "</tr>";
  foreach($gittags as $courseyear => $gittag){
    echo "<tr><td colspan='6'>Processing: ".$gittag."</td>";
    $foo=file_get_contents("data_blame_".$gittag.".js");
    $startpos=1;
    $endpos=strlen($foo);
    echo "<td colspan='6'>File length".$endpos."</td></tr>";
    $j=0;
    $i=$startpos;
    
    while($i < $endpos){
        set_time_limit ( 30 );      
        $workstr="";
        $cnt=0;
        $fo=0;
        while($fo==0){
          $workchr=substr($foo,$i,1);
          if($workchr=="{"){
              $cnt++;	
          }else if($workchr=="}"){
              $cnt--;
              if($cnt==0){
                  $fo=1;
                  $i++;
              }
          }
          if($foo==0) $workstr.=$workchr;
        
          $i++;
          
        }
    
        $fileo=json_decode($workstr);
        if(is_object($fileo)){
          $j++;  
          $purl=$fileo->purl;
          $path=$fileo->path;
          $filename=$fileo->filename;
          $fileinfo=$fileo->fileinfo;
          $fileinfo=substr($fileinfo,7);
          $filelines=substr($fileinfo,0,strpos($fileinfo," "));
          $filez=substr($fileinfo,0,strrpos($fileinfo," "));
          $filesize=substr($filez,strrpos($filez," "));
          
          $harvestdate=date('Y-m-d H:i:s');
          
          echo "<tr>";
          echo "<td>".$purl."</td>";
          echo "<td>".$path."</td>";
          echo "<td>".$filename."</td>";
          echo "<td>".$filelines."</td>";
          echo "<td>".$filesize."</td>";
          echo "<td>".$harvestdate."</td>";
          echo "<td>".$i."</td>";
          echo "</tr>";
          
          try{
              $query = $log_db->prepare('INSERT INTO Bfile(purl,path,filename, filesize, filelines, harvestdate,courseyear,gittag) VALUES (:purl,:path,:filename,:filesize,:filelines,:harvestdate,:courseyear,:gittag)');
              $query->bindParam(':purl', $purl);
              $query->bindParam(':path', $path);
              $query->bindParam(':filename', $filename);
              $query->bindParam(':filelines', $filelines);
              $query->bindParam(':filesize', $filesize);
              $query->bindParam(':harvestdate', $harvestdate);
              $query->bindParam(':courseyear', $courseyear);
              $query->bindParam(':gittag', $gittag);
              $query->execute();
              
              $fileid=$log_db->lastInsertId(); 
    
          }catch(PDOException $e){
              echo $e->getMessage();
          }
          
          foreach($fileo->blames as $bkey => $blame){		
              $rowcnt=$blame->rowcnt;				
              $blamedate=$blame->blamedate;
              $blameuser=$blame->blameuser;	
              $blameuser=$blameuser;		
              $href=substr($blame->href,21);
              $mess=$blame->mess;
              
              try{
                $query = $log_db->prepare('INSERT INTO Blame(blamedate,blameuser,href,mess,rowcnt,fileid,courseyear,gittag) VALUES (:blamedate,:blameuser,:href,:mess,:rowcnt,:fileid,:courseyear,:gittag)');
      
                $query->bindParam(':blamedate', $blamedate);
                $query->bindParam(':blameuser', $blameuser);
                $query->bindParam(':href', $href);
                $query->bindParam(':mess', $mess);
                $query->bindParam(':rowcnt', $rowcnt);
                $query->bindParam(':fileid', $fileid);
                $query->bindParam(':courseyear', $courseyear);
                $query->bindParam(':gittag', $gittag);
        
                $query->execute();
                $blameid=$log_db->lastInsertId(); 
                
                foreach($blame->rows as $rkey => $row){		
                    echo "<tr>";
        
                    $rowno=$row->row;
                    $code=$row->code;
                    
                    $code=str_replace("__","&lt;",$code);
                    $code=str_replace("**","&gt;",$code);
        
                    $query = $log_db->prepare('INSERT INTO CodeRow(fileid,blameid,blameuser,rowno,code,courseyear,gittag) VALUES (:fileid,:blameid,:blameuser,:rowno,:code,:courseyear,:gittag)');
            
                    $query->bindParam(':fileid', $fileid);
                    $query->bindParam(':blameid', $blameid);
                    $query->bindParam(':blameuser', $blameuser);
                    $query->bindParam(':rowno', $rowno);
                    $query->bindParam(':code', $code);
                    $query->bindParam(':courseyear', $courseyear);
                    $query->bindParam(':gittag', $gittag);    
                    $query->execute();
                }  
              }catch(PDOException $e){
                echo $e->getMessage();
              }
              
          }
      
      
        }else{
            echo "Error json decoding: ".$fileo;
        }
        ob_flush();
        flush();
        //sleep(1);
    }
    echo "<tr><td colspan='6'>Finished processing: ".$gittag."</td><td>Found: ".$j." files.</td></tr>";
  }
}
?> 

</table>
<table>

<?php 
	
//$log_db = new PDO('sqlite:'.$dbFile);

// Fix database. Any user names that have been changed are reverted to last known login name

echo "<tr><td>Diamond Reo</td></tr>";
	
$fixfile=file_get_contents("fix_git_names.txt");
	
$items=explode("\n",$fixfile);	
foreach($items as $item){
		$cont=explode(",",$item);
		$fromname=$cont[0];
		$toname=$cont[1];
		echo "<tr>";
		echo "<td>".$fromname."</td><td>".$toname."</td>";

	
		$query = $log_db->prepare('UPDATE commitgit set author="'.$toname.'" where author="'.$fromname.'"');
		$query->execute();
	 	echo "<td>".$query->rowCount()."</td>";

		$query = $log_db->prepare('UPDATE commitdata set author="'.$toname.'" where author="'.$fromname.'"');
		$query->execute();
	 	echo "<td>".$query->rowCount()."</td>";

		$query = $log_db->prepare('UPDATE event set author="'.$toname.'" where author="'.$fromname.'"');
		$query->execute();
	 	echo "<td>".$query->rowCount()."</td>";
  
    /*
		$query = $log_db->prepare('UPDATE comment set author="'.$toname.'" where author="'.$fromname.'"');
		$query->execute();	
	 	echo "<td>".$query->rowCount()."</td>";
    */

		$query = $log_db->prepare('UPDATE issue set author="'.$toname.'" where author="'.$fromname.'"');
		$query->execute();
	 	echo "<td>".$query->rowCount()."</td>";
	
		echo "</tr>";	
		
}	

?> 
</table>

<table>
<?php 

//$log_db = new PDO('sqlite:'.$dbFile);

$query = $log_db->prepare('INSERT INTO stud(fornamn, efternamn, sex, anmkod, program, termin, ar, kurskod, kursnamn, poang, grupp, rol, roletime, author) VALUES ("UNK","UNK","O","","","","","","","","","","","unknown")');
$query->execute();

$query = $log_db->prepare('INSERT INTO stud(fornamn, efternamn, sex, anmkod, program, termin, ar, kurskod, kursnamn, poang, grupp, rol, roletime, author) VALUES ("Henrik","Gustavsson","T","","","","","","","","","","","HGustavs")');
$query->execute();

$query = $log_db->prepare('INSERT INTO stud(fornamn, efternamn, sex, anmkod, program, termin, ar, kurskod, kursnamn, poang, grupp, rol, roletime, author) VALUES ("Alexander","Kratsch","T","","","","","","","","","","","klump")');
$query->execute();

$query = $log_db->prepare('INSERT INTO stud(fornamn, efternamn, sex, anmkod, program, termin, ar, kurskod, kursnamn, poang, grupp, rol, roletime, author) VALUES ("Marcus","Brohede","T","","","","","","","","","","","a97marbr")');
$query->execute();

$query = $log_db->prepare('INSERT INTO stud(fornamn, efternamn, sex, anmkod, program, termin, ar, kurskod, kursnamn, poang, grupp, rol, roletime, author) VALUES ("Andras","Marki","T","","","","","","","","","","","andras-marki")');
$query->execute();

$handle = fopen("rumpak.csv", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
 				$items=explode (",",$line);
        $eftername=substr($items[1],1);
        $fornamn=substr($items[2],0,-1);
        $anmkod=$items[4];
        $sex=$items[3];
        $program=substr($items[6],1,5);
        $termin=substr($items[7],0,4);
        $ar=$items[9];
        $kurskod=$items[10];
        $kursnamn=$items[11];
        $poang=$items[13];
        $grupp=$items[14];
        $roll=$items[18];
        $rolltime=$items[19];
        $author=$items[20];
				$query = $log_db->prepare('INSERT INTO stud(fornamn, efternamn, sex, anmkod, program, termin, ar, kurskod, kursnamn, poang, grupp, rol, roletime, author) VALUES (:fornamn, :efternamn, :sex, :anmkod, :program, :termin,:ar,:kurskod,:kursnamn,:poang,:grupp,:rol,:roletime,:author)');
				$query->bindParam(':efternamn', $eftername);
				$query->bindParam(':fornamn', $fornamn);
				$query->bindParam(':anmkod', $anmkod);
				$query->bindParam(':sex', $sex);
				$query->bindParam(':program', $program);
				$query->bindParam(':termin', $termin);
				$query->bindParam(':ar', $ar);
				$query->bindParam(':kurskod', $kurskod);
				$query->bindParam(':kursnamn', $kursnamn);
				$query->bindParam(':poang', $poang);
				$query->bindParam(':grupp', $grupp);
				$query->bindParam(':rol', $roll);
				$query->bindParam(':roletime', $rolltime);
				$query->bindParam(':author', $author);


				$query->execute();
    }

    fclose($handle);

		$query = $log_db->prepare('INSERT INTO stud(fornamn, efternamn, sex, anmkod, program, termin, ar, kurskod, kursnamn, poang, grupp, rol, roletime, author) VALUES ("Henrik","Gustavsson","T","","","","","","","","","","","HGustavs")');
		$query->execute();

} else {
    // error opening the file.
} 

?>
<script>alert("Database has been generated!");</script>
</table>
</body>
</html>