	<div class="menu">
		<ul id="nav" class="dropdown dropdown-horizontal">
        
			 <li><span class="dir">Generate Data</span>
				<ul>
					<li><a href="index.php?id=<?=base64_encode('generate')?>" >Generate Data<br/>(No Have Toyota)</a></li>
					<li><a href="index.php?id=<?=base64_encode('generate_toyota')?>" >Generate Data for Toyota</a></li>
			   </ul>
		 	</li>
        <li><a href="index.php?id=<?=base64_encode('report')?>" >Report for EBS</a></li>
        <li><a href="index.php?id=<?=base64_encode('report_exported')?>" >Exported Report</a></li>
        <li><span class="dir">Manage Master Data</span>
				<ul>
					<li><a href="index.php?id=<?=base64_encode('manage')?>" >Manage customer data<br/>(No Have Toyota)</a></li>
					<li><a href="index.php?id=<?=base64_encode('manage_toyota')?>" >Manage Toyota Master data</a></li>
     				<li><a href="index.php?id=<?=base64_encode('model')?>" >Manage model pass thru</a></li>
					<li><a href="index.php?id=<?=base64_encode('manage_toyota_calulate')?>" >Manage Toyota <br/>Formula Calculation</a></li>
			   </ul>
		 	</li>
          <li><a target="_blank" href="exp/EBS_REPORT.pdf" >Work Instruction</a></li>   
		</ul>
	</div>