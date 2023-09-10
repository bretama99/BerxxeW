<div id="sidebar" class="sidebar responsive ace-save-state">
	<div class="Side_bar">
		<script type="text/javascript">
			try {
				ace.settings.loadState('sidebar')
			} catch (e) {}
		</script>
		<div class="sidebar-shortcuts" id="sidebar-shortcuts">
			<br>
			<br>
		</div>
		<ul class="nav nav-list">
			<?php
			// Random String Generator
			function generateRandomString($length = 5){
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$charactersLength = strlen($characters);
				$randomString = '';
				for ($i = 0; $i < $length; $i++) {
					$randomString .= $characters[rand(0, $charactersLength - 1)];
				}
				return $randomString;
			}
			$Random_String = generateRandomString();
			if (isset($_SESSION['Random_String'])) {
				$_SESSION['Pre_Rs'] = $_SESSION['Random_String'];
			}

			$_SESSION['Random_String'] = $Random_String;
			$rm_query = "select menusVarName,tasksVarName from tasks join menus ON tasks.menusId=menus.menusId where tasksVarName='$tasksVarNameGet'";
			$rm_stmt = $con->prepare($rm_query);
			$rm_success = $rm_stmt->execute();
			$rm_rows = $rm_stmt->fetchAll();
			foreach ($rm_rows as $row) {
				$menusVarNameSelected = $row['menusVarName'];
			}


			$rolesId = $_SESSION['rolesId'];
			$rm_query = "select menusVarName,menusId,icon,canView from menus";
			$rm_stmt = $con->prepare($rm_query);
			$rm_success = $rm_stmt->execute();
			$rm_rows = $rm_stmt->fetchAll();
			foreach ($rm_rows as $rowm) {
				$canViewM = $rowm['canView'];
				if (strpos($canViewM, $rolesId) !== false) {
					$menusVarName = $rowm['menusVarName'];
					$icon = $rowm['icon'];
					$menusId = $rowm['menusId'];
					$activeOpen = $menusVarName == $menusVarNameSelected ? "active open" : "";
			?>
					<li class="<?php echo $activeOpen; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="<?php echo $icon; ?>"></i>
							<span class="menu-text">
								<?php echo $lang[$menusVarName]; ?>
							</span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<?php
							$rm_query = "select tasksVarName,tasksUrl,canView from tasks where menusId='$menusId' order by tasksOrder";
							$rm_stmt = $con->prepare($rm_query);
							$rm_success = $rm_stmt->execute();
							$rm_rows = $rm_stmt->fetchAll();
							foreach ($rm_rows as $rowt) {
								$canViewT = $rowt['canView'];
								if (strpos($canViewT, $rolesId) !== false) {
									$tasksVarName = $rowt['tasksVarName'];
									$tasksUrl = $rowt['tasksUrl'] . $_SESSION['set'] = '';
									$active = $tasksVarName == $tasksVarNameGet ? "active" : "";

							?>
									<li class="<?php echo $active; ?>">
										<a href="<?php echo $tasksUrl; ?>">
											<i class="menu-icon fa fa-caret-right"></i>
											<?php echo $lang[$tasksVarName]; ?>
										</a>

										<b class="arrow"></b>
									</li>
							<?php }
							} ?>
						</ul>
					</li>
			<?php }
			} ?>

		</ul><!-- /.nav-list -->

		<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
			<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
		</div>
	</div>
</div>