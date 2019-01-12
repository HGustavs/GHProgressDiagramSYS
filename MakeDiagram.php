<html>
	<head>
		<title>PHP Test</title>
	</head>

<body>
<div>	
<form action="MakeDiagram.php" method="POST">
<?php 
		// -------------------------------------------------------------------------------------------------------
		// -----------------=============######## Real Time Tracing Library ########=============-----------------
		// -------------------------------------------------------------------------------------------------------
		//  Copyright / HGustavs / a97marbr / Influenced by some ideas from PoTrace
		//
		//        (\ /)
		//        (. .)           
		//       c(")(")                             ∴ 
		//--------------------------------------------------------------------------------------------------------

		//------------==========########### GLOBALS ###########==========------------

	/*
		$leadcolor="fill:#f8b";
		$issuecolor="fill:#8bf";
		$othercolor="fill:#8fb";

		$leadcolord="fill:#d59";
		$issuecolord="fill:#59d";
		$othercolord="fill:#5d9";

		$leadcolordd="fill:#b26";
		$issuecolordd="fill:#26b";
		$othercolordd="fill:#2b6";
*/
		$leadcolor="fill:#f8b";
		$issuecolor="fill:#59d";
		$othercolor="fill:#bfe";

		$leadcolord="fill:#d59";
		$issuecolord="fill:#47b";
		$othercolord="fill:#7fa";

		$leadcolordd="fill:#b26";
		$issuecolordd="fill:#26b";
		$othercolordd="fill:#2b6";

		$colorarr=array(
			array($leadcolor,$issuecolor,$othercolor,$leadcolord,$issuecolord,$othercolord),
			array($leadcolor,$issuecolor,$othercolor,$leadcolord,$issuecolord,$othercolord),
			array($leadcolor,$issuecolor,$othercolor,$leadcolord,$issuecolord,$othercolord),
			array($leadcolor,$issuecolor,$othercolor,$leadcolord,$issuecolord,$othercolord),
			array($leadcolor,$issuecolor,$othercolor,$leadcolord,$issuecolord,$othercolord),
			array($leadcolor,$issuecolor,$othercolor,$leadcolord,$issuecolord,$othercolord),
			array($leadcolor,$issuecolor,$othercolor,$leadcolord,$issuecolord,$othercolord),
			array($leadcolor,$issuecolor,$othercolor,$leadcolord,$issuecolord,$othercolord),
			array($leadcolor,$issuecolor,$othercolor,$leadcolord,$issuecolord,$othercolord),
			array($leadcolor,$issuecolor,$othercolor,$leadcolord,$issuecolord,$othercolord),
			array($leadcolor,$issuecolor,$othercolor,$leadcolord,$issuecolord,$othercolord));
			
		$colordarr = array(
			array($leadcolord,$issuecolord,$othercolord,$leadcolordd,$issuecolordd,$othercolordd),
			array($leadcolord,$issuecolord,$othercolord,$leadcolordd,$issuecolordd,$othercolordd),
			array($leadcolord,$issuecolord,$othercolord,$leadcolordd,$issuecolordd,$othercolordd),
			array($leadcolord,$issuecolord,$othercolord,$leadcolordd,$issuecolordd,$othercolordd),
			array($leadcolord,$issuecolord,$othercolord,$leadcolordd,$issuecolordd,$othercolordd),
			array($leadcolord,$issuecolord,$othercolord,$leadcolordd,$issuecolordd,$othercolordd),
			array($leadcolord,$issuecolord,$othercolord,$leadcolordd,$issuecolordd,$othercolordd),
			array($leadcolord,$issuecolord,$othercolord,$leadcolordd,$issuecolordd,$othercolordd),
			array($leadcolord,$issuecolord,$othercolord,$leadcolordd,$issuecolordd,$othercolordd),
			array($leadcolord,$issuecolord,$othercolord,$leadcolordd,$issuecolordd,$othercolordd),
			array($leadcolord,$issuecolord,$othercolord,$leadcolordd,$issuecolordd,$othercolordd));		
			
		$legendarr = array(
			array("Early leader","Early issue","Other","Late leader","Late issue",""),
			array("Early leader","Early issue","Other","Late leader","Late issue",""),
			array("Early leader","Early issue","Other","Late leader","Late issue",""),
			array("","DVSUG","WEBUG","","",""),
			array("","DVSUG","WEBUG","","",""),
			array("","Male leader role","Female leader role","", "Male other","Female other"),
			array("Early leader","Early issue","Other","Late leader","Late issue","Late other"),
			array("Early leader","Early issue","Other","Late leader","Late issue","Late other"),
			array("","","","","",""),
			array("Early leader","Early issue","Early other","Late leader","Late issue","Late other"),
			array("Early leader","Early issue","Early other","Late leader","Late issue","Late other"));
		$year = array("2014","2015","2016","2017","2018","ALL");
		$xaxis = array(
			"Students ordered by rank",
			"Students ordered by rank",
			"Students ordered by rank",
			"Students ordered by rank",
			"Students ordered by rank",
			"Students ordered by rank",
			"Students ordered by rank",
			"Students ordered by rank",
			"Calendar weeks",
			"Students ordered by rank",
			"Students ordered by rank");
		$yaxis = array(
			"# GitHub Issues",
			"# Git commits",
			"# GitHub events",
			"# GitHub issues",
			"# Git commits",
			"# Git commits",
			"# Git commits",
			"# Git commits",
			"# branch levels",
			"# Git commits",
			"# Git commits"		
		);



		echo "<select name='diagram' onchange='this.form.submit()'>";
				if($_POST['diagram']==0){
						echo "<option value='0' selected='selected'>Issue Per Student Role Year</option>";		
				}else{
						echo "<option value='0'>Issue Per Student Year</option>";				
				}
				if($_POST['diagram']==1){
						echo "<option value='1' selected='selected'>Gitcommit Per Student Role Year</option>";
				}else{
						echo "<option value='1'>Gitcommit Per Student Year</option>";
				}
				if($_POST['diagram']==2){
						echo "<option value='2' selected='selected'>Event Per Student Role Year</option>";
				}else{
						echo "<option value='2'>Event Per Student Year</option>";
				}
				if($_POST['diagram']==3){
						echo "<option value='3' selected='selected'>Issue Per Program Student Year</option>";
				}else{
						echo "<option value='3'>Issue Per Program Student Year</option>";
				}
				if($_POST['diagram']==4){
						echo "<option value='4' selected='selected'>Commit Per Program Student Year</option>";
				}else{
						echo "<option value='4'>Commit Per Program Student Year</option>";
				}
				if($_POST['diagram']==5){
						echo "<option value='5' selected='selected'>Commit Per Sex Year</option>";
				}else{
						echo "<option value='5'>Commit Per Sex Year</option>";
				}
				if($_POST['diagram']==6){
						echo "<option value='6' selected='selected'>Commit Per Issue Per Year</option>";
				}else{
						echo "<option value='6'>Commit Per Student Year</option>";
				}
				if($_POST['diagram']==8){
						echo "<option value='8' selected='selected'>GIT Commit Analysis</option>";
				}else{
						echo "<option value='8'> GIT Commit Analysis</option>";
				}
				if($_POST['diagram']==9){
						echo "<option value='9' selected='selected'>Itemized</option>";
				}else{
						echo "<option value='9'>Itemized</option>";
				}
				if($_POST['diagram']==10){
						echo "<option value='10' selected='selected'>Itemized Line Diagram</option>";
				}else{
						echo "<option value='10'>Itemized Line Diagram</option>";
				}
				if($_POST['diagram']==11){
						echo "<option value='11' selected='selected'>Lines of Code Diagram</option>";
				}else{
						echo "<option value='11'>Lines of Code Diagram</option>";
				}
				if($_POST['diagram']==12){
						echo "<option value='12' selected='selected'>Lines of Code P Year Diagram</option>";
				}else{
						echo "<option value='12'>Lines of Code P Year Diagram</option>";
				}	
		echo "</select>";

		echo "<select name='kind' onchange='this.form.submit()'>";
				if($_POST['kind']==0){
						echo "<option selected='selected' value='0'>Diagram</option>";
				}else{
						echo "<option value='0'>Diagram</option>";
				}
				if($_POST['kind']==1){
						echo "<option selected='selected' value='1'>Table</option>";
				}else{
						echo "<option value='1'>Table</option>";
				}
		echo "</select>";

		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
	?>
</form>
</div>


<table>
<?php 

//------------==========########### GLOBALS ###########==========------------

$maketable=$_POST['kind'];
$kind=$_POST['diagram'];

$leftoffs="106";
$topoffs="50";
$bottoffs="25";

$graphWidth="500";
$graphHeight="150";
$graphSpacer=($graphHeight)+10;

$yearsize="35";

$arrowWidth="4";
$arrowHeight="18";	
	
$log_db = new PDO('sqlite:../githubdata/OSSPaper2019/GHdata.db');
date_default_timezone_set('Europe/Berlin' );

//------------==========########### Main Functions ###########==========------------

//--------------------------------------------------------------------------
// go
// ---------------
//  Calls the right function depending on the kind of diagram
//--------------------------------------------------------------------------
	
function go(){
		global $kind;
	
		if($kind>=0&&$kind<=2){
				diagram_role($kind);		
		}else if($kind>2&&$kind<6){
				diagram_program($kind);				
		}else if($kind>=6&&$kind<8){
				diagram_commits($kind);
		}else if($kind>=8&&$kind<9){
				diagram_git($kind);
		}else if($kind>=9&&$kind<11){
				diagram_itemized($kind);
		}else if($kind>=11&&$kind<12){
				diagram_loc($kind);
		}else if($kind>=12&&$kind<13){
				diagram_locY($kind);
		}
}
				
//--------------------------------------------------------------------------
// makestart
// ---------------
//  Calls the right function depending on the kind of diagram
//--------------------------------------------------------------------------

function makestart($svgstr)
{
		if(!$maketable){
										echo "<svg width='800' height='1220' style='border:1px solid red;'>";
										echo $svgstr;
										echo "</svg>"; 
		}else{
				echo "</table>";
		}						
}
    
//--------------------------------------------------------------------------
// background
// ---------------
//  makes the background for most diagrams (excluding the topology diagram?)
//--------------------------------------------------------------------------

function background($kind,$graphHeight,$graphWidth,$graphSpacer)
{
		global $leftoffs;
		global $legendarr;
		global $colorarr;
		global $colordarr;
		global $legendoffset;
		global $year;
		global $xaxis;
		global $yaxis;
		global $topoffs;
		global $bottoffs;
		global $yearsize;

		global $arrowWidth;
		global $arrowHeight;

		// ----------------------------============###### Background ######============----------------------------
		$svgstr="";

		for($j=0;$j<count($legendarr[$kind]);$j++) {
			if ($j>=(count($legendarr[$kind])/2)) {$legendoffset=25;}
			if($legendarr[$kind][$j] != ""){
				$svgstr.="<rect x='".(20+((($j+1)%3)*130))."' y='".(4+$legendoffset)."' width='24' height='20' style='".$colordarr[$kind][$j]."' />";
				$svgstr.="<rect x='".(20+((($j+1)%3)*130))."' y='".(6+$legendoffset)."' width='22' height='18' style='".$colorarr[$kind][$j]."' />";						
				$svgstr.="<text x='".(45+((($j+1)%3)*130))."' y='".(22+$legendoffset)."' font-family='Arial Narrow' font-size='20'>".$legendarr[$kind][$j]."</text>";						
			}
		}

		for ($i=0;$i<6;$i++){
				// Year
				$svgstr.="<rect x='10' y='".($topoffs+($i*$graphSpacer))."' width='".($graphWidth)."' height='".($graphHeight)."' style='fill:#eee' />";
				$svgstr.="<text x='17' y='".($graphSpacer+($i*$graphSpacer))."' font-family='Arial Narrow' font-size='".$yearsize."' style='fill:#888' >".$year[$i]."</text>";
				$svgstr.="<text x='15' y='".(($graphSpacer-2)+($i*$graphSpacer))."' font-family='Arial Narrow' font-size='".$yearsize."' style='fill:#fff' >".$year[$i]."</text>";

				// Axis text
				$svgstr.="<text id='xaxislable".$i."' x='".(($leftoffs-60)+((410-$leftoffs)/2))."' y='".(($graphSpacer+34)+($i*$graphSpacer))."' font-family='Arial Narrow' font-size='16' style='fill:#888' >".$xaxis[$kind]."</text>";
				$svgstr.="<text id='yaxislable".$i."' x='".($leftoffs)."' y='".(($graphSpacer+38)+($i*$graphSpacer))."' font-family='Arial Narrow' font-size='16' style='fill:#888;' transform='rotate(-90,".($leftoffs-18).",".(($graphSpacer+26)+($i*$graphSpacer)).")' >".$yaxis[$kind]."</text>";

		}

		return $svgstr;		
}

//--------------------------------------------------------------------------
// background
// ---------------
//  makes the arrows and the vertical diagram axis.
//--------------------------------------------------------------------------
	
function postground($kind,$graphHeight,$graphWidth,$graphSpacer)
{
		global $leftoffs;
		global $legendarr;
		global $colorarr;
		global $colordarr;
		global $legendoffset;
		global $year;
		global $xaxis;
		global $yaxis;
		global $topoffs;
		global $bottoffs;
		global $yearsize;

		global $arrowWidth;
		global $arrowHeight;

		for ($i=0;$i<5;$i++){

				// Bottom and left line
				$svgstr.="<line x1='10' y1='".(($i+1)*$graphSpacer+15)."' x2='".($graphWidth)."' y2='".(($i+1)*$graphSpacer+15)."' stroke-width='2' stroke='black'/>";
				$svgstr.="<line x1='".($leftoffs-1)."' y1='".(10+$topoffs+($i*$graphSpacer))."' x2='".($leftoffs-1)."' y2='".(135+$topoffs+($i*$graphSpacer))."' stroke-width='2' stroke='black'/>";

				// Attempt at arrow-beard-head
				$svgstr.="<polygon points='";
				$svgstr.=($leftoffs-1).",".(5+$topoffs+($i*$graphSpacer));
				$svgstr.=",".($leftoffs-$arrowWidth-2).",".($arrowHeight+$topoffs+($i*$graphSpacer));
				$svgstr.=",".($leftoffs+$arrowWidth).",".($arrowHeight+$topoffs+($i*$graphSpacer));
				$svgstr.="' stroke-width='2' stroke='none' fill='black' />";

		}

		return $svgstr;		
}

		function diagram_git($kind)
		{
				global $maketable;
				global $log_db;
				global $leftoffs;
				global $topoffs;
				global $bottoffs;
				global $graphWidth;
				global $graphHeight;
				$graphSpacer=($graphHeight)+10;

				$svgstr=background($kind,$graphHeight,$graphWidth,$graphSpacer);
								
				if($maketable){
						echo "<table>";
				}
								
				$rowarr=Array();

				$query='select * from commitgit order by thetimed;';								
				$result = $log_db->query($query);
				$rows = $result->fetchAll();
				$i=0;


				// Preprocess commit hierarchy into an array
				foreach($rows as $row){
						$rowarr[$row['cid']]=$row;
				}
				
				$strokecolors=array("#000","#A00","#0A0","#00A","#AA0","#0AA","#A0A","#AAA","#A50","#0A5","#50A","#A05","#5A0","#05A","#555","#AA0","#0AA","#A0A","#AAA","#A50","#0A5","#50A","#A05","#5A0","#05A","#555","#A05","#5A0","#05A");
				
				$startday=92;
				$endday=72;
//				$xmult=4.5;
//				$ymult=4;
				$xmult=5.5;
 				$ymult=3.5;
				$yk=$topoffs+$graphSpacer;
				$xk=135;			
	
				// Draw Background depicting git weeks
				
				for($i=0;$i<10;$i++){
						if($i%2==1){
								$fillstd="fill:#cdc";
						}else{
								$fillstd="fill:#efe";								
						}
						for ($j=0;$j<5;$j++){
							$svgstr.="<rect x='".(($i*7*$xmult)+110)."' y='".($topoffs+($j*$graphSpacer))."' width='".($xmult*7)."' height='".($graphHeight-26)."' style='".$fillstd."' />";						

							// Clip Path!
			 				$svgstr.="<defs><clipPath id='daClip".($j+1)."'><rect x='110' y='".($topoffs+$j*$graphSpacer)."' width='".($xmult*7*10)."' height='".($graphHeight)."' style='fill:black' /></clipPath></defs>";
						}
				}
						
				// Draw diagram
				foreach($rows as $row){
					
						$rowarr[$row['cid']]=$row;
												
						$fillst="fill:#58d";				
						$fillstd="fill:#359";				

						$xxk=($row['thetimed']%365)-$startday;
						$strokecol=$strokecolors[$row['space']];
						
						// 2014 begins on wednesday (0-1-2)
						// 2015 begins on thursdag  (0-1-2-3)
						// 2016 begins on friday		(0-1-2-3-4)
						// 2017 begins on sunday    (0)
						// 2018 begins on monday		(0-1)

						if($row['thetimed']<365){
								$yk=$topoffs+$graphHeight-$bottoffs;
								$do=2;			// Day offset for 2014 == Wednesday e.g. 2
								$clipst="url(#daClip1)";
						}else if($row['thetimed']>=365&&$row['thetimed']<730){
								$yk=$topoffs+$graphSpacer+$graphHeight-$bottoffs;
								$do=1;			// Day offset for 2015 == Thursday e.g. 3
								$clipst="url(#daClip2)";
						}else if($row['thetimed']>=730&&$row['thetimed']<1095){
								$yk=$topoffs+2*$graphSpacer+$graphHeight-$bottoffs;
								$do=4;			// Day offset for 2016 == Friday e.g. 4
								$clipst="url(#daClip3)";
						}else if($row['thetimed']>=1095&&$row['thetimed']<1460){
								$yk=$topoffs+3*$graphSpacer+$graphHeight-$bottoffs;
								$do=4;			// Day offset for 2017 == Friday e.g. 4
								$clipst="url(#daClip4)";							
						}else{
								$yk=$topoffs+4*$graphSpacer+$graphHeight-$bottoffs;
								$do=-7;			// Day offset for 2017 == Friday e.g. 4
								$clipst="url(#daClip5)";
						}

/*
						if($row['cid']=="e34b150d6c847ae5a47b3622d35e2b6b40ae487d") $svgstr.="<line x1='".($xk+(($xxk-$do)*$xmult))."' y1='0' x2='".($xk+(($xxk-$do)*$xmult))."' y2='5000' stroke-width='1' stroke='blue' clip-path='".$clipst."' />";
						if($row['cid']=="b9294e840df220cc9ea5e330164f63a4f2c0b346") $svgstr.="<line x1='".($xk+(($xxk-$do)*$xmult))."' y1='0' x2='".($xk+(($xxk-$do)*$xmult))."' y2='5000' stroke-width='1' stroke='red' clip-path='".$clipst."' />";
						if($row['cid']=="42d10fad26dc6df13ad89bd42e1ed0bffc12b03f") $svgstr.="<line x1='".($xk+(($xxk-$do)*$xmult))."' y1='0' x2='".($xk+(($xxk-$do)*$xmult))."' y2='5000' stroke-width='1' stroke='green' clip-path='".$clipst."' />";
						if($row['cid']=="ae6bdd3d8584525c862e8bc13509cfbfb7169864") $svgstr.="<line x1='".($xk+(($xxk-$do)*$xmult))."' y1='0' x2='".($xk+(($xxk-$do)*$xmult))."' y2='5000' stroke-width='1' stroke='teal' clip-path='".$clipst."' />";
*/						

						// Only process if above day 80 of the year						
						if($xxk>-10&&$xxk<$endday){
								
							// $svgstr.="<text x='".($xk+(($xxk-$do)*$xmult)+1)."' y='".($yk-($row['space']*$ymult))."' font-family='Arial Narrow' font-size='14' style='fill:#fff' >".$row['thetimed']."</text>";

								if($row['p1id']!="UNK"){
										$parent=$rowarr[$row['p1id']];
										$pxk=($parent['thetimed']%365)-$startday;
										$svgstr.="<line x1='".($xk+(($xxk-$do)*$xmult)+1)."' y1='".($yk-($row['space']*$ymult))."' x2='".(($xk)+(($pxk-$do)*$xmult)+1)."' y2='".($yk-($parent['space']*$ymult))."' stroke-width='1.5' stroke='".$strokecol."' clip-path='".$clipst."' />";
										
										// No clip version
										//$svgstr.="<line x1='".($xk+(($xxk-$do)*$xmult)+1)."' y1='".($yk-($row['space']*$ymult))."' x2='".(($xk)+(($pxk-$do)*$xmult)+1)."' y2='".($yk-($parent['space']*$ymult))."' stroke-width='1.5' stroke='".$strokecol."' />";

								}
								if($row['p2id']!="UNK"){
										$descendant=$rowarr[$row['p2id']];
										$dxk=($descendant['thetimed']%365)-$startday;
										
										$svgstr.="<line x1='".($xk+(($xxk-$do)*$xmult)+1)."' y1='".($yk-($row['space']*$ymult))."' x2='".($xk+(($dxk-$do)*$xmult)+1)."' y2='".($yk-($descendant['space']*$ymult))."' stroke-width='1.5' stroke='".$strokecol."' clip-path='".$clipst."' />";												
										
										// No Clip version
										//$svgstr.="<line x1='".($xk+(($xxk-$do)*$xmult)+1)."' y1='".($yk-($row['space']*$ymult))."' x2='".($xk+(($dxk-$do)*$xmult)+1)."' y2='".($yk-($descendant['space']*$ymult))."' stroke-width='1.5' stroke='".$strokecol."' />";												

								}
		
								
								if($maketable){
										// Produce table row
										echo "<tr>";
										echo "<td>".$row['cid']."</td>";
										echo "<td>".$row['p1id']."</td>";
										echo "<td>".$row['p2id']."</td>";				
										echo "<td>".$row['thetimed']."</td>";				
										echo "<td>".$row['space']."</td>";				
										echo "</tr>";
								}
								
								// Iterate to next category
						
						}
						
						$i++;

				}

				$svgstr.=postground($kind,$graphHeight,$graphWidth,$graphSpacer);	
			
        makestart($svgstr);

		}

		function diagram_itemized($kind)
		{
				global $maketable;
				global $log_db;
				global $leftoffs;
				global $topoffs;
				global $graphSpacer;

				$svgstr=background($kind);
						
				// ----------------------------============###### Studtable ######============----------------------------
		
				if($maketable){
						echo "<table>";
				}
		
     		$svgstr.="<defs><linearGradient id='agrad1' x1='0%' y1='50' x2='0%' y2='120' gradientUnits='userSpaceOnUse'><stop offset='0%' style='stop-color:rgb(255,200,64);stop-opacity:1' /><stop offset='100%' style='stop-color:rgb(200,100,32);stop-opacity:1' /></linearGradient></defs>";
     		$svgstr.="<defs><linearGradient id='agrad2' x1='0%' y1='80' x2='0%' y2='130' gradientUnits='userSpaceOnUse'><stop offset='0%' style='stop-color:rgb(200,225,64);stop-opacity:1' /><stop offset='100%' style='stop-color:rgb(50,130,8);stop-opacity:1' /></linearGradient></defs>";
     		$svgstr.="<defs><linearGradient id='agrad3' x1='0%' y1='120' x2='0%' y2='130' gradientUnits='userSpaceOnUse'><stop offset='0%' style='stop-color:rgb(64,180,225);stop-opacity:1' /><stop offset='100%' style='stop-color:rgb(32,80,170);stop-opacity:1' /></linearGradient></defs>";
     		$svgstr.="<defs><linearGradient id='agrad4' x1='0%' y1='135' x2='0%' y2='145' gradientUnits='userSpaceOnUse'><stop offset='0%' style='stop-color:rgb(180,180,225);stop-opacity:1' /><stop offset='100%' style='stop-color:rgb(32,32,170);stop-opacity:1' /></linearGradient></defs>";

     		$svgstr.="<defs><linearGradient id='bgrad1' x1='0%' y1='170' x2='0%' y2='260' gradientUnits='userSpaceOnUse'><stop offset='0%' style='stop-color:rgb(255,200,64);stop-opacity:1' /><stop offset='100%' style='stop-color:rgb(200,100,32);stop-opacity:1' /></linearGradient></defs>";
     		$svgstr.="<defs><linearGradient id='bgrad2' x1='0%' y1='200' x2='0%' y2='260' gradientUnits='userSpaceOnUse'><stop offset='0%' style='stop-color:rgb(200,225,64);stop-opacity:1' /><stop offset='100%' style='stop-color:rgb(50,130,8);stop-opacity:1' /></linearGradient></defs>";
     		$svgstr.="<defs><linearGradient id='bgrad3' x1='0%' y1='240' x2='0%' y2='260' gradientUnits='userSpaceOnUse'><stop offset='0%' style='stop-color:rgb(64,180,225);stop-opacity:1' /><stop offset='100%' style='stop-color:rgb(32,80,170);stop-opacity:1' /></linearGradient></defs>";
     		$svgstr.="<defs><linearGradient id='bgrad4' x1='0%' y1='255' x2='0%' y2='265' gradientUnits='userSpaceOnUse'><stop offset='0%' style='stop-color:rgb(180,180,225);stop-opacity:1' /><stop offset='100%' style='stop-color:rgb(32,32,170);stop-opacity:1' /></linearGradient></defs>";

     		$svgstr.="<defs><linearGradient id='cgrad1' x1='0%' y1='290' x2='0%' y2='360' gradientUnits='userSpaceOnUse'><stop offset='0%' style='stop-color:rgb(255,200,64);stop-opacity:1' /><stop offset='100%' style='stop-color:rgb(200,100,32);stop-opacity:1' /></linearGradient></defs>";
     		$svgstr.="<defs><linearGradient id='cgrad2' x1='0%' y1='320' x2='0%' y2='360' gradientUnits='userSpaceOnUse'><stop offset='0%' style='stop-color:rgb(200,225,64);stop-opacity:1' /><stop offset='100%' style='stop-color:rgb(100,170,32);stop-opacity:1' /></linearGradient></defs>";
     		$svgstr.="<defs><linearGradient id='cgrad3' x1='0%' y1='355' x2='0%' y2='380' gradientUnits='userSpaceOnUse'><stop offset='0%' style='stop-color:rgb(64,180,225);stop-opacity:1' /><stop offset='100%' style='stop-color:rgb(32,80,170);stop-opacity:1' /></linearGradient></defs>";
     		$svgstr.="<defs><linearGradient id='cgrad4' x1='0%' y1='376' x2='0%' y2='390' gradientUnits='userSpaceOnUse'><stop offset='0%' style='stop-color:rgb(180,180,225);stop-opacity:1' /><stop offset='100%' style='stop-color:rgb(32,32,170);stop-opacity:1' /></linearGradient></defs>";

     		$svgstr.="<defs><linearGradient id='hgrad' x1='0%' y1='0%' x2='0%' y2='100%' ><stop offset='0%' style='stop-color:rgb(255,255,255);stop-opacity:1' /><stop offset='100%' style='stop-color:rgb(0,0,0);stop-opacity:1' /></linearGradient></defs>";


				// Gradient view!
/*
     		$svgstr.="<rect fill='url(#agrad1)' x='400' y='44' width='40' height='100' />";
     		$svgstr.="<rect fill='url(#agrad2)' x='440' y='44' width='40' height='100' />";
     		$svgstr.="<rect fill='url(#agrad3)' x='480' y='44' width='40' height='100' />";
     		$svgstr.="<rect fill='url(#agrad4)' x='520' y='44' width='40' height='100' />";

     		$svgstr.="<rect fill='url(#bgrad1)' x='400' y='164' width='40' height='100' />";
     		$svgstr.="<rect fill='url(#bgrad2)' x='440' y='164' width='40' height='100' />";
     		$svgstr.="<rect fill='url(#bgrad3)' x='480' y='164' width='40' height='100' />";
     		$svgstr.="<rect fill='url(#bgrad4)' x='520' y='164' width='40' height='100' />";

     		$svgstr.="<rect fill='url(#cgrad1)' x='400' y='284' width='40' height='100' />";
     		$svgstr.="<rect fill='url(#cgrad2)' x='440' y='284' width='40' height='100' />";
     		$svgstr.="<rect fill='url(#cgrad3)' x='480' y='284' width='40' height='100' />";
     		$svgstr.="<rect fill='url(#cgrad4)' x='520' y='284' width='40' height='100' />";
*/
		
				$query='select ar,stud.author,count(*) as rank,sum(issu) as issum,sum(comn) as comsum,sum(eve) as evesum,sum(commi) as commisum from (select id,author as eauthor, 1 as issu, 0 as comn, 0 as eve, 0 as commi from issue union select id,author as eauthor, 0 as issu, 1 as comn, 0 as eve, 0 as commi from comment union select id,author as eauthor, 0 as issu, 0 as comm,1 as eve, 0 as comme from event union select id, author as eauthor, 0 as issu, 0 as comm, 0 as eve, 1 as commi from commitgit),stud where stud.author=eauthor and sex!="T" and ar>=2014 group by stud.author order by ar,rank desc;';

				$result = $log_db->query($query);
				$rows = $result->fetchAll();
				$prevrow="";
				$i=0;
				$yk=$topoffs-36;
				
				$suffix="a";
										
				foreach($rows as $row){
					
						$issu=$row['issum']/8;
						$comsum=$row['comsum']/8;
						$evesum=$row['evesum']/8;
						$commisum=$row['commisum']/8;
												
						if($row['ar']!=$prevrow){
								$i=0;
								$yk+=$graphSpacer;
								if($yk<200){
										$suffix="a";
								}else if($yk<300){
										$suffix="b";
								}else if($yk<400){
										$suffix="c";
								}

								$oldissu=$issu;
								$oldcomsum=$comsum;
								$oldevesum=$evesum;
								$oldcommisum=$commisum;
						}

						if($kind==9){
								// Bars
								$svgstr.="<rect fill='url(#".$suffix."grad1)' x='".($leftoffs+($i*6))."' y='".($yk-$issu)."' width='6' height='".($issu)."' />";
								$svgstr.="<rect fill='url(#".$suffix."grad2)' x='".($leftoffs+($i*6))."' y='".($yk-$issu-$comsum)."' width='6' height='".($comsum)."' />";
								$svgstr.="<rect fill='url(#".$suffix."grad3)' x='".($leftoffs+($i*6))."' y='".($yk-$issu-$comsum-$evesum)."' width='6' height='".($evesum)."' />";
								$svgstr.="<rect fill='url(#".$suffix."grad4)' x='".($leftoffs+($i*6))."' y='".($yk-$issu-$comsum-$evesum-$commisum)."' width='6' height='".($commisum)."' />";

						// White/Black line on top commented out because: worse
/*
						$svgstr.="<rect fill='url(#hgrad)' x='".($leftoffs+($i*6))."' y='".($yk-$issu-3)."' width='6' height='3' />";
						$svgstr.="<rect fill='url(#hgrad)' x='".($leftoffs+($i*6))."' y='".($yk-$issu-$comsum-3)."' width='6' height='3' />";
						$svgstr.="<rect fill='url(#hgrad)' x='".($leftoffs+($i*6))."' y='".($yk-$issu-$comsum-$evesum-3)."' width='6' height='3' />";
						$svgstr.="<rect fill='url(#hgrad)' x='".($leftoffs+($i*6))."' y='".($yk-$issu-$comsum-$evesum-$commisum-3)."' width='6' height='3' />";
*/
						}else{
								// X is the same for every color
								$x1=($leftoffs+($i*6));
								$x2=($leftoffs+(($i+1)*6));

								// Y1 and Y3 are also same
								$y1=$yk;
								$y3=$yk;

								// Commits
								$y2=$yk-$oldissu-$oldcomsum-$oldevesum-$oldcommisum;
								$y4=$yk-$issu-$comsum-$evesum-$commisum;
								$svgstr.="<polygon points='";
								$svgstr.=$x1.",".$y1." ".$x1.",".$y2." ".$x2.",".$y4." ".$x2.",".$y3;
								$svgstr.="' fill='url(#".$suffix."grad1)' />";

								// Commits Line
								$svgstr.="<line x1='".$x1."' y1='".$y2."' x2='".$x2."' y2='".$y4."' stroke-width='2' stroke='white'/>";
								$svgstr.="<line x1='".$x1."' y1='".($y2-2)."' x2='".$x2."' y2='".($y4-2)."' stroke-width='2' stroke='black'/>";

								// Events
								$y2=$yk-$oldissu-$oldcomsum-$oldevesum;
								$y4=$yk-$issu-$comsum-$evesum;
								$svgstr.="<polygon points='";
								$svgstr.=$x1.",".$y1." ".$x1.",".$y2." ".$x2.",".$y4." ".$x2.",".$y3;
								$svgstr.="' fill='url(#".$suffix."grad2)' />";

								// Events Line
								$svgstr.="<line x1='".$x1."' y1='".$y2."' x2='".$x2."' y2='".$y4."' stroke-width='2' stroke='white'/>";
								$svgstr.="<line x1='".$x1."' y1='".($y2-2)."' x2='".$x2."' y2='".($y4-2)."' stroke-width='2' stroke='black'/>";

								// Comments
								$y2=$yk-$oldissu-$oldcomsum;
								$y4=$yk-$issu-$comsum;
								$svgstr.="<polygon points='";
								$svgstr.=$x1.",".$y1." ".$x1.",".$y2." ".$x2.",".$y4." ".$x2.",".$y3;
								$svgstr.="' fill='url(#".$suffix."grad3)' />";

								// Comments Line
								$svgstr.="<line x1='".$x1."' y1='".$y2."' x2='".$x2."' y2='".$y4."' stroke-width='2' stroke='white'/>";
								$svgstr.="<line x1='".$x1."' y1='".($y2-2)."' x2='".$x2."' y2='".($y4-2)."' stroke-width='2' stroke='black'/>";

								// Issues
								$y2=$yk-$oldissu;
								$y4=$yk-$issu;
								$svgstr.="<polygon points='";
								$svgstr.=$x1.",".$y1." ".$x1.",".$y2." ".$x2.",".$y4." ".$x2.",".$y3;
								$svgstr.="' fill='url(#".$suffix."grad4)' />";

								// Issue Line
								$svgstr.="<line x1='".$x1."' y1='".$y2."' x2='".$x2."' y2='".$y4."' stroke-width='2' stroke='white'/>";
								$svgstr.="<line x1='".$x1."' y1='".($y2-2)."' x2='".$x2."' y2='".($y4-2)."' stroke-width='2' stroke='black'/>";

						}

						
						$i++;
						$prevrow=$row['ar'];
		
						$oldissu=$issu;
						$oldcomsum=$comsum;
						$oldevesum=$evesum;
						$oldcommisum=$commisum;				
				}

				$svgstr.=postground($kind,$graphHeight,$graphWidth,$graphSpacer);	

				makestart($svgstr);
			
		}
	
		function diagram_locY($kind)
		{
				global $maketable;
				global $log_db;
				global $leftoffs;
				global $topoffs;
				global $bottoffs;
				global $graphSpacer;
				global $graphHeight;
				global $graphWidth;
				global $colorarr;
				global $colordarr;
				global $colorddarr;			
			
				$colors=array();
				$dcolors=array();			
				
				$colors["2014"]="fill:#f8b";
				$dcolors["2014"]="fill:#d59";			
			
				$colors["2015"]="fill:#59d";
				$dcolors["2015"]="fill:#47b";			

				$colors["2016"]="fill:#bfe";
				$dcolors["2016"]="fill:#7fa";			
			
				$colors["2017"]="fill:#bfe";
				$dcolors["2017"]="fill:#7fa";			

				$colors["2018"]="fill:#bfe";
				$dcolors["2018"]="fill:#7fa";			
			
				$svgstr=background($kind,$graphHeight,$graphWidth,$graphSpacer);

				$kind=6;
				$dvpcolor=$colorarr[$kind][1];
				$webcolor=$colorarr[$kind][2];

				$dvpcolord=$colordarr[$kind][4];
				$webcolord=$colordarr[$kind][5];

				$dvpcolordd=$colordarr[$kind][4];
				$webcolordd=$colordarr[$kind][5];
			
				$dvpcol="fill:#f88";
				$webcol="fill:#88f";
				$dvpcold="fill:#d44";
				$webcold="fill:#44d";

				$dvpcol="fill:#fff";
				$webcol="fill:#ccc";
			
				$query='select sum(rowcnt) as loc,stud.author,stud.ar,stud.program from Blame,stud where Blame.courseyear=stud.ar and blame.blameuser=stud.author group by stud.author order by loc desc;';
				$result = $log_db->query($query);
				$rows = $result->fetchAll();

				$i=0;
				$yk=$topoffs-36;
				$yk+=$graphSpacer;			
				foreach($rows as $row){
						// Do not reset iterator - color dependent on year
						$cnt=$row['loc']/50;
						if($cnt>98) $cnt=98;
						$cnt+=14;

						if($row['program']=="DVSUG"){
								$fillst=$dvpcol;				
								$fillstd=$dvpcold;				
						}else if($row['program']=="WEBUG"){
								$fillst=$webcol;				
								$fillstd=$webcold;				
						}			
					
						$svgstr.="<rect x='".($leftoffs+($i*8))."' y='".($yk-$cnt)."' width='8' height='".($cnt)."' style='".$fillst."' />";

						$i++;
				}

				$i=0;
				$yk=$topoffs-36;
				$yk+=$graphSpacer;			
				foreach($rows as $row){
						// Do not reset iterator - color dependent on year
					
						$fillst=$colors[$row['ar']];				
						$fillstd=$dcolors[$row['ar']];
						
						$cnt=$row['loc']/50;
					
						if($cnt>98) $cnt=98;
						
						// stroke-width:3;stroke:rgb(0,0,0)
						$svgstr.="<rect x='".($leftoffs+($i*8))."' y='".($yk-$cnt-2)."' width='10' height='".($cnt)."' style='".$fillstd."' />";
						$svgstr.="<rect x='".($leftoffs+($i*8))."' y='".($yk-$cnt)."' width='8' height='".($cnt)."' style='".$fillst."' />";
					
						// Iterate to next category
						$i++;
				}
			
				$svgstr.=postground($kind,$graphHeight,$graphWidth,$graphSpacer);

				makestart($svgstr);
		}	
		
		function diagram_loc($kind)
		{
				global $maketable;
				global $log_db;
				global $leftoffs;
				global $topoffs;
				global $bottoffs;
				global $graphSpacer;
				global $graphHeight;
				global $graphWidth;
				global $colorarr;
				global $colordarr;
				global $colorddarr;			

				$svgstr=background($kind,$graphHeight,$graphWidth,$graphSpacer);

				$kind=6;
				$dvpcolor=$colorarr[$kind][1];
				$webcolor=$colorarr[$kind][2];

				$dvpcolord=$colordarr[$kind][4];
				$webcolord=$colordarr[$kind][5];

				$dvpcolordd=$colordarr[$kind][4];
				$webcolordd=$colordarr[$kind][5];

				$query='select sum(rowcnt) as loc,stud.author,stud.ar,stud.program from Blame,stud where Blame.courseyear=stud.ar and blame.blameuser=stud.author group by stud.author order by stud.ar,loc desc;';

				$result = $log_db->query($query);
				$rows = $result->fetchAll();
				$prevrow="";
				$i=0;
				$yk=$topoffs-36;
				foreach($rows as $row){
						// Reset iterator
						if($row['ar']!=$prevrow){
								$i=0;
								$yk+=$graphSpacer;
						}

						if($row['program']=="DVSUG"){
								$fillst=$dvpcolor;				
								$fillstd=$dvpcolord;				
						}else if($row['program']=="WEBUG"){
								$fillst=$webcolor;				
								$fillstd=$webcolord;				
						}			
						
						$cnt=$row['loc']/50;
					
						if($cnt>98) $cnt=98;
						
						// stroke-width:3;stroke:rgb(0,0,0)
						$svgstr.="<rect x='".($leftoffs+($i*8))."' y='".($yk-$cnt-2)."' width='10' height='".($cnt)."' style='".$fillstd."' />";
						$svgstr.="<rect x='".($leftoffs+($i*8))."' y='".($yk-$cnt)."' width='8' height='".($cnt)."' style='".$fillst."' />";
						
						// Iterate to next category
						$i++;
						$prevrow=$row['ar'];
				}
			
				$svgstr.=postground($kind,$graphHeight,$graphWidth,$graphSpacer);

				makestart($svgstr);
		}
	
		function diagram_commits($kind)
		{
				global $maketable;
				global $log_db;
				global $leftoffs;
				global $topoffs;
				global $bottoffs;
				global $graphSpacer;
				global $graphHeight;
				global $graphWidth;

				$svgstr=background($kind,$graphHeight,$graphWidth,$graphSpacer);
						
				// ----------------------------============###### Studtable ######============----------------------------
		
				if($maketable){
						echo "<table>";
				}
				
				if($kind==6){			
						$query='select issueno,count(*) as cnt,ar from commitdata,stud WHERE commitdata.author=stud.author and ar>=2014 group by issueno order by ar,cnt desc;';								
				}
			
				$result = $log_db->query($query);
				$rows = $result->fetchAll();
				$prevrow="";
				$i=0;
				$yk=$topoffs-36;
				foreach($rows as $row){
						// Reset iterator
						if($row['ar']!=$prevrow){
								$i=0;
								$yk+=$graphSpacer;
						}

						$fillst="fill:#58d";				
						$fillstd="fill:#359";;				
						
						$cnt=$row['cnt']/3;

						if($cnt>98) $cnt=98;
						
						// stroke-width:3;stroke:rgb(0,0,0)
						$svgstr.="<rect x='".($leftoffs+($i*8))."' y='".($yk-$cnt-2)."' width='10' height='".($cnt)."' style='".$fillstd."' />";
						$svgstr.="<rect x='".($leftoffs+($i*8))."' y='".($yk-$cnt)."' width='8' height='".($cnt)."' style='".$fillst."' />";
						
						if($maketable){
								// Produce table row
								echo "<tr>";
								echo "<td>".$i."</td>";
								echo "<td>".$row['ar']."</td>";
								echo "<td>".$row['cnt']."</td>";				
								echo "</tr>";
						}
						
						// Iterate to next category
						$i++;
						$prevrow=$row['ar'];
				}
						      
				//$svgstr.="<text x='15' y='475' font-family='Arial Narrow' font-size='60' style='fill:#fff' >ALL</text>";

				$svgstr.=postground($kind,$graphHeight,$graphWidth,$graphSpacer);	
			
				makestart();
					
		}
		
		function diagram_program($kind)
		{
				global $maketable;
				global $log_db;
				global $leftoffs;
				global $topoffs;
				global $graphSpacer;
				global $graphHeight;
				global $graphWidth;
				global $colorarr;
				global $colordarr;
				global $colorddarr;

				$svgstr=background($kind,$graphHeight,$graphWidth,$graphSpacer);
						
				// ----------------------------============###### Studtable ######============----------------------------
		
				if($maketable){
						echo "<table>";
				}
		
				if($kind==3){
						$query='SELECT stud.author, program, ar,count(*) as cnt FROM stud,issue WHERE issue.author=stud.author AND stud.sex!="T" AND ar>=2014 GROUP BY stud.author ORDER BY stud.ar,cnt desc;';								
				}else if($kind==4){
						$query='SELECT stud.author, program, ar,count(*) as cnt FROM stud,commitgit WHERE commitgit.author=stud.author AND stud.sex!="T" AND ar>=2014 GROUP BY stud.author ORDER BY stud.ar,cnt desc;';												
				}else if($kind==5){
						$query='SELECT stud.author, program, sex, rol, ar,count(*) as cnt FROM stud,commitgit WHERE commitgit.author=stud.author AND stud.sex!="T" AND ar>=2014 GROUP BY stud.author ORDER BY stud.ar,cnt desc;';												
				}
/*
				$dvpcolor="fill:#8bf";
				$webcolor="fill:#8fb";
				
				$dvpcolord="fill:#59d";
				$webcolord="fill:#4c8";

				$dvpcolordd="fill:#269";
				$webcolordd="fill:#175";
*/
				$dvpcolor=$colorarr[$kind][1];
				$webcolor=$colorarr[$kind][2];

				$dvpcolord=$colordarr[$kind][4];
				$webcolord=$colordarr[$kind][5];

				$dvpcolordd=$colordarr[$kind][4];
				$webcolordd=$colordarr[$kind][5];

				$result = $log_db->query($query);
				$rows = $result->fetchAll();
				$prevrow="";
				$i=0;
				$yk=$topoffs-36;
										
				foreach($rows as $row){
						// Reset iterator
						if($row['ar']!=$prevrow){
								$i=0;
								$yk+=$graphSpacer;
						}

						if($row['program']=="DVSUG"){
								$fillst=$dvpcolor;				
								$fillstd=$dvpcolord;				
						}else if($row['program']=="WEBUG"){
								$fillst=$webcolor;				
								$fillstd=$webcolord;				
						}
						
						if($kind==5){
								if($row['sex']=="M"){
										if($row['rol']=="L"||$row['rol']=="I"){
												$fillst=$colorarr[$kind][1];
												$fillstd=$colorarr[$kind][4];				
										}else{
												$fillst=$colordarr[$kind][1];				
												$fillstd=$colordarr[$kind][4];				
										}
								}else{
										if($row['rol']=="L"||$row['rol']=="I"){
												$fillst=$webcolor;				
												$fillstd=$webcolord;				
										}else{
												$fillst=$webcolord;				
												$fillstd=$webcolordd;				
										}
								}						
						}
						
						if($kind==3||$kind==5){
								$cnt=$row['cnt']/2;						
						}else if($kind==4){
								$cnt=$row['cnt']/2;
						}
						if($cnt>120) $cnt=120;
						
						// stroke-width:3;stroke:rgb(0,0,0)
						$svgstr.="<rect x='".($leftoffs+($i*8))."' y='".($yk-$cnt-2)."' width='10' height='".($cnt)."' style='".$fillstd."' />";
						$svgstr.="<rect x='".($leftoffs+($i*8))."' y='".($yk-$cnt)."' width='8' height='".($cnt)."' style='".$fillst."' />";
						
						if($maketable){
								// Produce table row
								echo "<tr>";
								echo "<td>".$i."</td>";
								echo "<td>".$row['author']."</td>";
								echo "<td>".$row['ar']."</td>";
								echo "<td>".$row['program']."</td>";				
								echo "<td>".$row['sex']."</td>";
								echo "<td>".$row['rol']."</td>";
								echo "<td>".$row['cnt']."</td>";				

								echo "</tr>";
						}
						
						// Iterate to next category
						$i++;
						$prevrow=$row['ar'];
				}
		      
				//$svgstr.="<text x='15' y='475' font-family='Arial Narrow' font-size='60' style='fill:#fff' >ALL</text>";
		
				$svgstr.=postground($kind,$graphHeight,$graphWidth,$graphSpacer);	

				makestart($svgstr);
				
		}
		

		function diagram_role($kind)
		{
				global $maketable;
				global $log_db;
				global $leftoffs;
				global $topoffs;
				global $graphSpacer;
				global $graphHeight;
				global $graphWidth;
				global $bottoffs;
			
		
				$leadcolor="fill:#f8b";
				$issuecolor="fill:#8bf";
				$othercolor="fill:#8fb";
				
				$leadcolord="fill:#d59";
				$issuecolord="fill:#59d";
				$othercolord="fill:#5d9";
		
				$leadcolordd="fill:#b26";
				$issuecolordd="fill:#26b";
				$othercolordd="fill:#2b6";
				
				$svgstr=background($kind,$graphHeight,$graphWidth,$graphSpacer);
						
				// ----------------------------============###### Studtable ######============----------------------------
		
				if($maketable){
						echo "<table>";
				}
		
				if($kind==0){
						$query='SELECT stud.author, rol, roletime, ar,count(*) as cnt FROM stud,issue WHERE issue.author=Stud.author AND stud.sex!="T" GROUP BY stud.author ORDER BY stud.ar,cnt desc;';								
				}else if($kind==1){
						$query='SELECT stud.author, rol, roletime, ar,count(*) as cnt FROM stud,commitgit WHERE commitgit.author=Stud.author AND stud.sex!="T" AND ar>=2014 GROUP BY stud.author ORDER BY stud.ar,cnt desc;';												
				}else if($kind==2){
						$query='SELECT stud.author, rol, roletime, ar,count(*) as cnt FROM stud,event WHERE event.author=stud.author AND stud.sex!="T" AND ar>=2014 GROUP BY stud.author ORDER BY stud.ar,cnt desc;';
				}

				$result = $log_db->query($query);
				$rows = $result->fetchAll();
				$prevrow="";
				$i=0;
				$yk=$topoffs-36;
						
				$leadrc=0;
				$leadrv=0;
				$issrc=0;
				$issrv=0;
				
				foreach($rows as $row){
						// Reset iterator
						if($row['ar']!=$prevrow){
								// Draw averages
								if($issrc>0&&$leadrc>0){
									/*
										$svgstr.="<text x='420' y='".($yk-70)."' font-family='Arial Narrow' font-size='20' style='fill:#000' >Lavg: ".($leadrv/$leadrc)."</text>";
										$svgstr.="<text x='420' y='".($yk-20)."' font-family='Arial Narrow' font-size='20' style='fill:#000' >Iavg: ".($issrv/$issrc)."</text>";
										*/
								}

								$i=0;
								$yk+=$graphSpacer;

								$leadrc=0;
								$leadrv=0;
								$issrc=0;
								$issrv=0;
						}

						if($row['rol']=="I"&&$i<10){
								$issrc++;
								$issrv+=10-$i;
						}else if($row['rol']=="L"&&$i<10){
								$leadrc++;
								$leadrv+=10-$i;
						}

						if($row['roletime']==1||$row['rol']==""){
								if($row['rol']=="I"){
										$fillst=$issuecolor;				
										$fillstd=$issuecolord;				
								}else if($row['rol']=="L"){
										$fillst=$leadcolor;				
										$fillstd=$leadcolord;				
								}else{
										$fillst=$othercolor;				
										$fillstd=$othercolord;					
								}
						}else{
								if($row['rol']=="I"){
										$fillst=$issuecolord;				
										$fillstd=$issuecolordd;				
								}else if($row['rol']=="L"){
										$fillst=$leadcolord;				
										$fillstd=$leadcolordd;				
								}else{
										$fillst=$othercolord;				
										$fillstd=$othercolordd;					
								}				
						}
						
						if($kind==0){
								$cnt=$row['cnt'];						
						}else if($kind==1){
								$cnt=$row['cnt']/2;
						}else if($kind==2){
								$cnt=$row['cnt']/5;
						}
						if($cnt>120) $cnt=120;
						
						// stroke-width:3;stroke:rgb(0,0,0)
						$svgstr.="<rect x='".($leftoffs+($i*8))."' y='".($yk-$cnt-2)."' width='10' height='".($cnt)."' style='".$fillstd."' />";
						$svgstr.="<rect x='".($leftoffs+($i*8))."' y='".($yk-$cnt)."' width='8' height='".($cnt)."' style='".$fillst."' />";
						
						if($maketable){
								// Produce table row
								echo "<tr>";
								echo "<td>".$i."</td>";
								echo "<td>".$row['author']."</td>";
								echo "<td>".$row['ar']."</td>";
								echo "<td>".$row['rol']."</td>";				
								echo "<td>".$row['cnt']."</td>";				
								echo "</tr>";
						}
						
						// Iterate to next category
						$i++;
						$prevrow=$row['ar'];
				}
		
				if($maketable){
						echo "</table>";
				}else{
						// Draw averages
						/*
						$svgstr.="<text x='420' y='".($yk-70)."' font-family='Arial Narrow' font-size='20' style='fill:#000' >Lavg: ".($leadrv/$leadrc)."</text>";
						$svgstr.="<text x='420' y='".($yk-20)."' font-family='Arial Narrow' font-size='20' style='fill:#000' >Iavg: ".($issrv/$issrc)."</text>";
						*/
				}
		
				// ----------------------------============###### Alldiagram ######============----------------------------
		
				if($kind==0){
						$query='SELECT stud.author, rol, roletime, ar,count(*) as cnt FROM stud,issue WHERE issue.author=Stud.author AND stud.sex!="T" GROUP BY stud.author ORDER BY cnt desc;';				
				}else if($kind==1){
						$query='SELECT stud.author, rol, roletime, ar,count(*) as cnt FROM stud,commitgit WHERE commitgit.author=Stud.author AND stud.sex!="T" AND ar>=2014 GROUP BY stud.author ORDER BY cnt desc;';				
				}else if($kind==2){
						$query='SELECT stud.author, rol, roletime, ar,count(*) as cnt FROM stud,event WHERE event.author=stud.author AND stud.sex!="T" AND ar>=2014 GROUP BY stud.author ORDER BY cnt desc;';
				}

				$result = $log_db->query($query);
				$rows = $result->fetchAll();
				$yk+=$graphSpacer;
		
				$i=0;
				foreach($rows as $row){
		
						if($row['roletime']==1||$row['rol']==""){
								if($row['rol']=="I"){
										$fillst=$issuecolor;				
										$fillstd=$issuecolord;				
								}else if($row['rol']=="L"){
										$fillst=$leadcolor;				
										$fillstd=$leadcolord;				
								}else{
										$fillst=$othercolor;				
										$fillstd=$othercolord;					
								}
						}else{
								if($row['rol']=="I"){
										$fillst=$issuecolord;				
										$fillstd=$issuecolordd;				
								}else if($row['rol']=="L"){
										$fillst=$leadcolord;				
										$fillstd=$leadcolordd;				
								}else{
										$fillst=$othercolord;				
										$fillstd=$othercolordd;					
								}				
						}
						
						// stroke-width:3;stroke:rgb(0,0,0)
						if($kind==0){
								$cnt=$row['cnt'];						
						}else if($kind==1){
								$cnt=$row['cnt']/2;												
						}else if($kind==2){
								$cnt=$row['cnt']/5;	
						}
						if($cnt>98) $cnt=98;
						
						// stroke-width:3;stroke:rgb(0,0,0)
						$svgstr.="<rect x='".($leftoffs+($i*3))."' y='".($yk-$cnt-2)."' width='5' height='".($cnt)."' style='".$fillstd."' />";
						$svgstr.="<rect x='".($leftoffs+($i*3))."' y='".($yk-$cnt)."' width='3' height='".($cnt)."' style='".$fillst."' />";
						
						// Iterate to next category
						$i++;
				}
/*		
				$svgstr.="<line x1='10' y1='144' x2='410' y2='144' stroke-width='2' stroke='black'/>";
				$svgstr.="<line x1='10' y1='264' x2='410' y2='264' stroke-width='2' stroke='black'/>";
				$svgstr.="<line x1='10' y1='384' x2='410' y2='384' stroke-width='2' stroke='black'/>";
				$svgstr.="<line x1='10' y1='504' x2='410' y2='504' stroke-width='2' stroke='black'/>";
		      
				$svgstr.="<text x='15' y='475' font-family='Arial Narrow' font-size='60' style='fill:#fff' >ALL</text>";
	*/	
                
				$svgstr.=postground($kind,$graphHeight,$graphWidth,$graphSpacer);	
				makestart($svgstr);
		}
		
		go();
	
?> 

</body>
</html>