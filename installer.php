<?php
// Get server url
$url = 'https://' . $_SERVER['HTTP_HOST'];
// Output messages
$response = '';

/* Install function */
function install($config_file = 'system/config.php') {
	$contents = '<?php' . PHP_EOL;
	// Write new variables to files
	foreach ($_POST as $k => $v) {
		if ($k == 'code') continue;
        $v = in_array(strtolower($v), ['true', 'false']) || is_numeric($v) ? strtolower($v) : '\'' . $v . '\'';
        $contents .= 'define(\'' . $k . '\',' . $v . ');' . PHP_EOL;
    }
	$contents .= '?>';
	if (!file_put_contents($config_file, $contents)) {
		return FALSE;
	}
	return TRUE;
}

/*Verify Purchase Code function*/
function verify($code)
{
	
	/*If the submit form is success*/
	if(!empty($code)){
		
		/*add purchase code to the API link*/
		$purchase_code = $code;
		$url = "https://dl.supers0ft.us/anonuptest/api.php?code=".$purchase_code;
		$curl = curl_init($url);
		
		/*Set your personal token*/
		// $personal_token = "9COT6mduU2sZSMIlC09aYAQveaRdQ2H9";
		
		/*Correct header for the curl extension*/
		$header = array();
		$header[] = 'Authorization: Bearer '.$personal_token;
		$header[] = 'User-Agent: Purchase code verification';
		$header[] = 'timeout: 20';
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER,$header);
		
		/*Connect to the API, and get values from there*/
		$envatoCheck = curl_exec($curl);
		curl_close($curl);
		$envatoCheck = json_decode($envatoCheck);
		
		/*Variable request from the API*/
		$date = new DateTime(isset($envatoCheck->supported_until) ? $envatoCheck->supported_until : false);							
		$support_date = $date->format('Y-m-d H:i:s');
		$sold = new DateTime(isset($envatoCheck->sold_at) ? $envatoCheck->sold_at : false);
		$sold_at = $sold->format('Y-m-d H:i:s');
		$buyer = (isset( $envatoCheck->buyer) ? $envatoCheck->buyer : false);
		$license = (isset( $envatoCheck->license) ? $envatoCheck->license : false);
		$count = (isset( $envatoCheck->purchase_count) ? $envatoCheck->purchase_count : false);
		$support_amount = (isset( $envatoCheck->support_amount) ? $envatoCheck->support_amount : false);
		$item  = (isset( $envatoCheck->item->previews->landscape_preview->landscape_url ) ? $envatoCheck->item->previews->landscape_preview->landscape_url  : false);

		
		/*Check for Special Characters*/
		if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬]/', $code)){
		   	return 'Not allowed to use special characters!';	
		}
		
		/*Check for Empty Spaces*/
		if(!isset($code) || trim($code) == ''){
			return 'You need to fill up the input area!';	
		}
		
		/*If Purchase code exists, But Purchase ended*/
		if (isset($envatoCheck->item->name) && (date('Y-m-d H:i:s') >= $support_date)){   
			return "
				<div class='alert alert-danger' role='alert'>
					<h3>{$envatoCheck->item->name}</h3>										
					<div class='row'>
						<div class='center-box'>
							<div class='col-md-6'>
								<img src='{$item}' class='img-responsive' />
							</div>
							<div class='col-md-6'>
								<table class='table table-striped'>
								<thead>
									<tbody>
									<tr>
										<td><b>CLIENT:</b></td>													
										<td>{$buyer}</td>
									</tr>
									<tr>
										<td><b>SOLD AT:</b></td>
										<td> {$sold_at}</td>
									</tr>
									<tr>
										<td><b>SUPPORT UNTIL:</b></td>
										<td> {$support_date}</td>
									</tr>
									<tr>
										<td><b>LICENSE:</b></td>
										<td> {$license}</td>
									</tr>
									<tr>
										<td><b>COUNT:</b></td>
										<td> {$count}</td>
									</tr>
									<tr>
										<td><b>SUPPORT EXTENSION:</b></td>
										<td> {$support_amount}</td>
									</tr>
								</tbody>
							  </table>  													
							</div>
						</div>
					</div>
				</div>
			";
		}

		/*If Purchase code exists, display client information*/
		if (isset($envatoCheck->item->name) && (date('Y-m-d H:i:s') < $support_date)){    
			if (!install()) {
				return '<h3>Error!</h3><p>Could not write to file! Please check permissions and try again!</a>';
			}
			return "
				<div class='alert alert-success' role='alert'>
					<h3>{$envatoCheck->item->name}</h3>										
					<div class='row'>
						<div class='center-box'>
							<div class='col-md-6'>
								<img src='{$item}' class='img-responsive' />
							</div>
							<div class='col-md-6'>
								<table class='table table-striped'>
								<thead>
									<tbody>
									<tr>
										<td><b>CLIENT:</b></td>													
										<td>{$buyer}</td>
									</tr>
									<tr>
										<td><b>SOLD AT:</b></td>
										<td> {$sold_at}</td>
									</tr>
									<tr>
										<td><b>SUPPORT UNTIL:</b></td>
										<td> {$support_date}</td>
									</tr>
									<tr>
										<td><b>LICENSE:</b></td>
										<td> {$license}</td>
									</tr>
									<tr>
										<td><b>COUNT:</b></td>
										<td> {$count}</td>
									</tr>
									<tr>
										<td><b>SUPPORT EXTENSION:</b></td>
										<td> {$support_amount}</td>
									</tr>
								</tbody>
							  </table>  													
							</div>
						</div>
					</div>
				</div> 
			";
		}

		/*If Purchase Code doesn't exist, no information will be displayed*/
		if (!isset($envatoCheck->item->name)){ 											
			return " 
				<div class='alert alert-danger' role='alert'>
					<h3>INVALID PURCHASE CODE.</h3>
					<div class='row'>
						<div class='center-box'>
							<div class='col-md-6'>
								<img src='img/profile.png' class='img-responsive' />
							</div>
							<div class='col-md-6'>
								<table class='table table-striped'>
								<thead>
									<tbody>
									<tr>
										<td><b>CLIENT:</b></td>													
										<td> NOT VERIFIED</td>
									</tr>
									<tr>
										<td><b>SOLD AT:</b></td>
										<td> NONE</td>
									</tr>
									<tr>
										<td><b>SUPPORT UNTIL:</b></td>
										<td> NONE</td>
									</tr>
									<tr>
										<td><b>LICENSE:</b></td>
										<td> NONE</td>
									</tr>
									<tr>
										<td><b>COUNT:</b></td>
										<td> NONE</td>
									</tr>
									<tr>
										<td><b>SUPPORT EXTENSION:</b></td>
										<td> NONE</td>
									</tr>
								</tbody>
							  </table>  													
							</div>
						</div>
					</div>
				</div>
			";
		} 

	}
}

if ($_POST) {
    if (isset($_POST['code'])) {
		// Validate code
		$response = verify($_POST['code']);
	} else {
		// No code specified
		$response = '<h3>Error!</h3><p>Please enter your Envato code!</p>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Installer</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<form class="installer-form" method="post" action="">
			
			<h1><i class="fa-solid fa-box-open"></i>Installer</h1>

			<div class="steps">
				<div class="step current"></div>
				<div class="step"></div>
				<div class="step"></div>
				<div class="step"></div>
				<div class="step"></div>
			</div>

			<div class="step-content current" data-step="1">
				<div class="fields">

					<label for="email">Admin Email</label>
					<div class="field">
						<i class="fas fa-envelope"></i>
						<input id="email" type="email" name="email" placeholder="Your Email Address" required>
					</div>

					<label for="password">Password</label>
					<div class="field">
						<i class="fas fa-lock"></i>
						<input id="password" type="password" name="password" placeholder="Password" minlength="8" required>
					</div>

					<label for="app_name">App Name</label>
					<div class="field">
						<input id="app_name" type="text" name="app_name" placeholder="App Name" required>
					</div>

					<label for="app_desc">App Description</label>
					<div class="field">
						<input id="app_desc" type="text" name="app_desc" placeholder="App Description" required>
					</div>

				</div>
				<div class="buttons">
					<a href="#" class="btn" data-set-step="2">Next</a>
				</div>
			</div>

			<div class="step-content" data-step="2">
				<div class="fields">

					<label for="FILELIST">File List</label>
					<div class="field">
						<input id="FILELIST" type="text" name="FILELIST" placeholder="Comma-seperated list of supported files" required value="jpeg,jpg,gif,png,zip,xls,doc,mp3,mp4,mpeg,wav,avi,rar,7z,txt">
					</div>

					<p>Options</p>
					<div class="group">
						<label for="size_verification">
							<input type="checkbox" name="size_verification" id="size_verification">
							Size Verification
						</label>
					</div>

					<!-- file destination - do not change or script won't work -->
					<div class="field">
						<input id="file_destination" type="hidden" name="file_destination" placeholder="File Destination" value="files"readonly required>
					</div>

					<label for="file_destination">Site URL</label>
					<div class="field">
						<input id="file_destination" type="text" name="file_url_destination" placeholder="https://example.com/anonupload" value="<?php echo $url; ?>" required>
					</div>

				</div>
				<div class="buttons">
					<a href="#" class="btn" data-set-step="1">Prev</a>
					<a href="#" class="btn" data-set-step="3">Next</a>
				</div>
			</div>

			<div class="step-content" data-step="3">
				<div class="fields">

					<label for="max_size">Maximum Size In Bytes</label>
					<div class="field">
						<input id="max_size" type="number" name="max_size" placeholder="Maximum Size" required>
					</div>

					<label for="min_size">Minimum Size In Bytes</label>
					<div class="field">
						<input id="min_size" type="number" name="min_size" placeholder="Minimum Size" required>
					</div>

					<!-- OTHER FORM ELEMENTS
					<p>Features</p>
					<div class="group">
						<label for="feature1">
							<input type="checkbox" name="feature1" id="feature1">
							Enable Feature 1
						</label>
						<label for="feature2">
							<input type="checkbox" name="feature2" id="feature2">
							Enable Feature 2
						</label>
						<label for="feature3">
							<input type="checkbox" name="feature3" id="feature3">
							Enable Feature 3
						</label>		
					</div>

					<p>Account Permissions</p>
					<div class="group">
						<label for="radio6">
							<input type="radio" name="account_permissions" id="radio6" value="full">
							Full
						</label>
						<label for="radio7">
							<input type="radio" name="account_permissions" id="radio7" value="strict">
							Strict
						</label>		
					</div>

					<p>Maximum number of accounts</p>
					<div class="rating">
						<input type="radio" name="maximum_accounts" id="radio1" value="5">
						<label for="radio1">5</label>
						<input type="radio" name="maximum_accounts" id="radio2" value="10">
						<label for="radio2">10</label>
						<input type="radio" name="maximum_accounts" id="radio3" value="20">
						<label for="radio3">20</label>
						<input type="radio" name="maximum_accounts" id="radio4" value="50">
						<label for="radio4">50</label>
						<input type="radio" name="maximum_accounts" id="radio5" value="80">
						<label for="radio5">80</label>
					</div>
					-->

				</div>
				<div class="buttons">
					<a href="#" class="btn alt" data-set-step="2">Prev</a>
					<a href="#" class="btn" data-set-step="4">Next</a>
				</div>
			</div>

			<div class="step-content" data-step="4">
				<div class="fields">
					<label for="code">Envato Code</label>
					<div class="field">
						<i class="fa-solid fa-key"></i>
						<input id="code" type="text" name="code" placeholder="Your Purchase Code" required>
					</div>
				</div>
				<div class="buttons">
					<a href="#" class="btn alt" data-set-step="3">Prev</a>
					<input type="submit" class="btn" value="Submit">
				</div>
			</div>

			<div class="step-content" data-step="5">
				<div class="result"><?=$response?></div>
			</div>

		</form>

		<script>
		document.querySelectorAll("input[type='checkbox']").forEach(checkbox => {
			checkbox.onclick = () => checkbox.value = checkbox.checked ? 'true' : 'false';
		});
		const setStep = step => {
			document.querySelectorAll(".step-content").forEach(element => element.style.display = "none");
			document.querySelector("[data-step='" + step + "']").style.display = "block";
			document.querySelectorAll(".steps .step").forEach((element, index) => {
				index < step-1 ? element.classList.add("complete") : element.classList.remove("complete");
				index == step-1 ? element.classList.add("current") : element.classList.remove("current");
			});
		};
		document.querySelectorAll("[data-set-step]").forEach(element => {
			element.onclick = event => {
				event.preventDefault();
				let canContinue = true;
				document.querySelectorAll('input').forEach(element => {
					if (!element.checkValidity() && element.offsetWidth !== 0 && element.offsetHeight !== 0) {
						canContinue = false;
						element.reportValidity();
					}
				});
				if (canContinue) {
					setStep(parseInt(element.dataset.setStep));
				}
			};
		});
		<?php if (!empty($_POST)): ?>
		setStep(5);
		<?php endif; ?>
		</script>

	</body>
</html>