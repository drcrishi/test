<style type="text/css">
        tr{
        	width: 100%;
        }
        td {
        	padding: 10px;
        }
        th {
        	background: #ECECEC;
        	padding: 6px;
        	text-align: center;
        }
        td.border-top-none {
        	border-bottom: 0;
        	border-top: 0;
        }
        td.border-bottom-none{
        	border-bottom: 0;
        }
        tr.subtotal-tr{
        	height: 35px;
        }
        td.color-green{
            color: green;
            font-weight: 700;
            border: 1px solid #000;
        }
        td.color-red{
            color: red;
            font-weight: 700; 
            border: 1px solid #000;
        }
        .download-div{
        	padding-top: 20px;
        }
        @media only screen and (max-width: 767px) {
        .reports{margin-top: 25px;}
        .reports table td, .reports table th{font-size: 12px;}
    }
        
        
    </style>

    <table border="1" style="width:100%;" id="report-table">
    	<tr>
    		<th>Packer Name</th>
    		<th>Service Date</th>
    		<th>Client Name</th>
    		<th>State</th>
    		<th>Packer Total Hours</th>
    	</tr>
    	<?php 
    	if(count($result)>0){
    		$packerName="";
    		$serviceDate="";
    		$state="";
    		$totalHours=0;
    		$loopCounter=0;
            $totalJobHours=0;
    		foreach ($result as $row) {
    			?>
    			<tr>
    				<?php 
    				if($packerName != $row['packer_name']){
    					echo "<td class='border-bottom-none'>";
    					echo $row['packer_name']; 
    					echo "</td>";
    					$packerName = $row['packer_name'];
    					$serviceDate="";
    					$totalHours= $row['packer_total_hours'];
    				}
    				else{
    					echo "<td class='border-top-none'>";
    					echo "</td>";
    					$totalHours+= $row['packer_total_hours'];
    				}
    				if($serviceDate != $row['en_servicedate']){
    					echo "<td class='border-bottom-none'>";
    					echo date("d-m-Y", strtotime($row['en_servicedate'])); 
    					echo "</td>";
    					$serviceDate = $row['en_servicedate'];
    				}
    				else{
    					echo "<td class='border-top-none'>";
    					echo "</td>";
    				}
    				?>
    				<td> <?php echo $row['client_name'] ?></td>
    				<td> <?php echo $row['en_movetype']=='4'? $row['en_movingfrom_state']:$row['en_movingto_state']  ?></td>
    				<td class="text-right"> <?php echo $row['packer_total_hours'] ?></td>
    				<?php
    				if($packerName != $result[$loopCounter + 1]['packer_name']){
    					echo "<tr class='subtotal-tr'>
    					<td colspan='2'></td>
    					<td colspan='2' class='color-green text-right'>Total Hours Worked</td>
    					<td colspan='1' class='color-green text-right'>".$totalHours."</td>
    					</tr>";
    				}
    				?>
    			</tr>
    			<?php
    			$loopCounter++;
                $totalJobHours+=$row['packer_total_hours'];
    		}
            echo "<tr class='subtotal-tr'>
            <td colspan='2'></td>
            <td colspan='2' class='color-red text-right'>Grand Total</td>
            <td colspan='1' class='color-red text-right'>".$totalJobHours." Hours</td>
            </tr>";
            echo "<tr class='subtotal-tr'>
            <td colspan='2'></td>
            <td colspan='2' class='color-red text-right'>Wages</td>
            <td colspan='1' class='color-red text-right'><i class='fa fa-usd'></i> ".round($totalJobHours * 30, 2)."</td>
            </tr>";
            echo "<tr class='subtotal-tr'>
            <td colspan='2'></td>
            <td colspan='2' class='color-red text-right'>Super</td>
            <td colspan='1' class='color-red text-right'><i class='fa fa-usd'></i> ".round($totalJobHours * 2.85, 2)."</td>
            </tr>";
    	}
    	else{
    		echo "<tr><td colspan='5' style='text-align:center'> No Records Found</td></tr>";
    	}
    	?>	
    </table>
    <!-- <div class="ajaxLoader">
    </div> -->
	<script>
        var currentRequest = null;    
		jQuery( "#exportPDFviewer" ).click(function() {
			jQuery.ajax({
				type: 'POST',
				url: BASE_URL + "WagesReport/getWageReport/pdf",
				data: jQuery("#wages-report-form").serialize(),
                beforeSend: function() {    
                    jQuery(".ajaxLoader").show();
                },
				success: function (response) {               
					jQuery(".reports").html(response);
				    jQuery(".ajaxLoader").hide();	
				}
			})
		});

		jQuery( "#exportXLSviewer" ).click(function() {
			currentRequest = jQuery.ajax({
				type: 'POST',
				url: BASE_URL + "WagesReport/getWageReport/xls",
				data: jQuery("#wages-report-form").serialize(),
                beforeSend : function(){           
                    if(currentRequest != null) {
                        currentRequest.abort();
                    }
                    jQuery(".ajaxLoader").show();
                },
				success: function (response) {   
                    // console.log(response);
					jQuery(".reports").html(response);
                    jQuery(".ajaxLoader").hide();
				}
			})
		});
	</script>