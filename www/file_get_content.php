<?php 

include('head.php');

echo '<div id="left"><div class="main"><table align=center  cellspacing="0" cellpadding="0" style="border-collapse: collapse;border:0px;">
		<tr>
		<form method=post action="'.$_SERVER['SCRIPT_NAME'].'">
		<td align=right style="padding:0px; border:0px; margin:0px;">
				<input type=submit name=home value="Home" class="side-pan">
		</td>
		<td  align=right style="padding:0px; border:0px; margin:0px;" >
				<input type=submit name=load value="Load File" class="side-pan">
		</td>
		
		<td  align=left style="padding:0px; border-width:0px; margin:0px;">
				<input type=submit name=us value="Who we are" class="side-pan">
		</td>
				</form></tr></table></div></div>
				<div id="right"></div><div align=center>';	
				
if(isset($_POST['home']))
{
	
	echo '<br><br><font size=5>This Lab is just to demonstrate how SSRF can be exploited to perform reading files/remote URLs';
	
}

if(isset($_POST['load']))
{
	
	echo '
   <table width="50%" cellspacing="0" cellpadding="0" class="tb1" style="opacity: 0.6;">
   <tr><td align=center style="padding: 10px;" >
	<form method=post action="'.$_SERVER['SCRIPT_NAME'].'">Specify the file name: <input type=text name=file value=local.txt><br><br><input type=submit name=read value="load file"></form>

   </td></tr></table>
   <table width="50%" cellspacing="0" cellpadding="0" class="tb1" style="margin:10px 2px 10px;opacity: 0.6;" >';

}  
if(isset($_POST['read']))
{
// Modified by Rezilant AI, 2025-11-21 17:06:01 GMT, Implemented whitelist-based file access and path traversal prevention to mitigate SSRF vulnerability
$file = trim($_POST['file']);

// Define allowed files (whitelist)
$allowedFiles = [
    'local.txt',
    'readme.txt',
    'info.txt'
];

// Validate that the requested file is in the whitelist
if (!in_array($file, $allowedFiles, true)) {
    echo '<div style="color:red;">Access denied. Invalid file requested.</div>';
    exit;
}

// Ensure file exists in the designated directory only
$baseDir = __DIR__ . '/allowed_files/';
$filePath = realpath($baseDir . $file);

// Verify the resolved path is within the allowed directory
if ($filePath === false || strpos($filePath, realpath($baseDir)) !== 0) {
    echo '<div style="color:red;">Access denied. Invalid file path.</div>';
    exit;
}

// Read and display the file content
if (file_exists($filePath)) {
    echo htmlentities(file_get_contents($filePath));
} else {
    echo '<div style="color:red;">File not found.</div>';
}
// Original Code
//$file=trim($_POST['file']);
//
//echo htmlentities(file_get_contents($file));

} 

if(isset($_POST['us']))
	{
		echo '
<table width="100%" cellspacing="0" cellpadding="0" class="tb1" style=" border:0px;background-color: #191919; opacity: 0.6;" >
			
       <tr><td 
        align="center"><img src="images/who.jpg"></td><td 
         align="center" valign="top" rowspan="1"><font 
        color="red" face="comic sans ms"size="1"><br><font color=white >
        --==[[Greetz to]]==--</font><br> <font color=#ff9933>Zero cool, code breaker ica, root_devil, google_warrior, INX_r0ot, Darkwolf indishell, Baba, Silent poison India, Magnum sniper, ethicalnoob Indishell, Local root indishell, Irfninja indishell<br>Reborn India, L0rd Crus4d3r, cool toad, Hackuin, Alicks, Gujjar PCP, Bikash, Dinelson Amine, Th3 D3str0yer, SKSking, rad paul, Godzila, mike waals, zoo zoo, cyber warrior, shafoon, Rehan manzoor<br>cyber gladiator,7he Cre4t0r, Cyber Ace, Golden boy INDIA, Ketan Singh, Yash, Aneesh Dogra, AR AR, saad abbasi, hero, Minhal Mehdi, Raj bhai ji, Hacking queen and rest of TEAM INDISHELL<br>
<font color=white>--==[[Love to]]==--</font><br># My Father, my Ex Teacher, cold fire hacker, Mannu, ViKi, Ashu bhai ji, Soldier Of God, Bhuppi, Gujjar PCP,
Mohit, Ffe, Ashish, Shardhanand, Budhaoo, Jagriti, Salty, Hacker fantastic, Jennifer Arcuri and Don(Deepika kaushik) <br><br>
       
						
           </table>
       </table> 
'; 
	}

?>