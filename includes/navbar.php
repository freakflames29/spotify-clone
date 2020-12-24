<div id="navbarContainer">
		<nav class="navbar">
			<!-- logo -->
			<!-- <a href="index.php" class="logo"> replacing with jquery dynamic page load -->
				<span  role="link" tabindex="0" onclick="onPage('index.php')" class="logo">
				<img src="includes/assets/images/icons/log.png" alt="logo">
				</span>
			<!-- </a> -->
			<!-- navigation item -->

			<div class="group">
				<div class="navitem">
					<!-- <a href="search.php" class="navitemLink">Search -->
					<span  role="link" tabindex="0" onclick="onPage('search.php')"  class="navitemLink">Search
					<img src="includes/assets/images/icons/search.png" class="searchIcon" alt="search ">
					</span>
				</div>

			</div>
			<div class="group">
				<div class="navitem">
					<!-- <a href="browse.php" class="navitemLink">Browse</a> -->
					<span  role="link" tabindex="0" onclick="onPage('browse.php')"class="navitemLink">Browse</span>
				</div>

				<div class="navitem">
					<!-- <a href="yourMusic.php" class="navitemLink">Your music</a> -->
					<span  role="link" tabindex="0" onclick="onPage('yourMusic.php')" class="navitemLink">Your music</span>
				</div>

				<div class="navitem">
					<!-- <a href="profile.php" class="navitemLink">Your profile</a> -->
					<span  role="link" tabindex="0" onclick="onPage('settings.php')"  class="navitemLink"><?php echo $userLoggedin->getuserName();?></a>
				</div>

			</div>
		</nav>

</div>
