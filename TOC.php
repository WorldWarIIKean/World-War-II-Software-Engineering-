<!DOCTYPE HTML>
<!--
	Helios by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Nancy Thompson WWII Scrapbook - Table of Contents</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="no-sidebar">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">

					<!-- Inner -->
						<div class="inner">
							<header>
								<h1><a href="TOC.html" id="logo">Table of Contents</a></h1>
							</header>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="index.html">Home</a></li>
								<li>
									<a href="#">Reading The Scrapbook</a>
									<ul>
										<li><a href="TOC.html">Table of Contents</a></li>
										<li><a href="no-sidebar.html">Search</a></li>
										<li><a href="years.php">Map by Year</a></li>
										<li>
											<a href="#">And a submenu &hellip;</a>
											<ul>
												<li><a href="#">Lorem ipsum dolor</a></li>
												<li><a href="#">Phasellus consequat</a></li>
												<li><a href="#">Magna phasellus</a></li>
												<li><a href="#">Etiam dolore nisl</a></li>
											</ul>
										</li>
										
									</ul>
								</li>
								<li><a href="index.html#slide">Experiencing WWII</a>
									<ul>
										<li><a href="index.html#letter writing">Letter Writing</a></li>
										<li><a href="index.html#wartime">Wartime Experience</a></li>
										<li><a href="index.html#homefront">Homefront</a></li>
										<li><a href="index.html#overseas">Overseas Experience</a></li>
										<li><a href="index.html#discovering">Discovering America</a></li>
										<li><a href="index.html#race">Race</a></li>
										<li><a href="index.html#women">Women</a></li>
										<li><a href="index.html#teachers">Teachers and Training</a></li>
										<li><a href="index.html#postwar">Postwar Education</a></li>
										<li><a href="index.html#thefallen">The Fallen</a></li>
										<li><a href="index.html#memory">Memory</a></li>
									</ul>
								</li>
								
								<li><a href="index.html#scrapbooking the war">Scrapbooking the War</a>
								  <ul>
											 <li><a href="index.html#Nancy">Nancy Thomspon</a></li>
											 <li><a href="index.html#newark">Newark State Teacher's College</a>
											 	 <ul>
												 <li><a href="#">School Newspaper</a></li>
												 <li><a href="#">Yearbooks</a></li>
												 <li><a href="#">Course Catalog</a></li>
												</ul>
											</li>
											 <li><a href="index.html#scrapbook">Scrapbook</a></li>
											 <li><a href="index.html#serviceman">Serviceman's News</a></li>
											 <li><a href="index.html#project">Project History</a></li>
								  </ul>		
								</li>
								
								
								<li><a href="#">Lesson Plans</a></li>
									<li><a href="#">Historial Analysis</a></li>
							</ul>
						</nav>

				</div>

			<!-- Main -->
				<div class="wrapper style1">
				
					<center>
      			 	<header>
								<h1><b><a>Last Name, First Name, # of Letters</a></b></h1>
							</header>
							</center>
     
		 
      <?php 

      include 'dbinfo.php';

      	try {

            /****************************
            * 
            * For DB in this web application part of the WW2 Letters project,
            * we're going to use the PHP Data Objects (PDO) library
            * Documentation on PDO: http://www.php.net/manual/en/book.pdo.php
            *
            ****************************/

	           $pdostring = 'mysql:host=' . $host . ';dbname=' . $dbname;

             //open the mysql connection using a PDO interface object
             $dbh = new PDO($pdostring, $user, $pass);
             
             //VERY ROUGH output of Query Array, first 10 rows of DB

             //thinking of making each toc entry hyperlink to a search result for that particular person
             //requires toc.php to change to GET instead of POST, and be able to pull the parameters out of the URL
             //TODO: get the names from $row here to properly escape

             $ncount = 0;

             echo  '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';

              echo  '<div class="panel panel-default" style="width:300px">';
                echo  '<div class="panel-heading" role="tab" id="ViewA-M" data-toggle="collapse" data-parent="#accordion" data-target="#collapseViewA-M">';
                  echo '<h2 class="panel-title" style="text-align:center">';
                    echo '<a class="accordion-toggle">';
                      echo 'A-M';
                    echo '</a>';
                  echo '</h2>';
                echo '</div>';

              echo '<div id="collapseViewA-M" class="panel-collapse collapse" role="tabpanel" aria-labelledby="ViewA-M">';
                echo '<div class="panel-body">';

             foreach($dbh->query('SELECT lastname,firstname, COUNT(*) AS "numOfLetters" from letters GROUP BY lastname, firstname;') as $row) {
                 //var_dump($row);
                 //print_r($row); echo '<br/><br/>';

                 if(strtolower(substr($row['lastname'],0,1)) > "m") { //the letter would be "n, o, p, q, r, s, t..."
                    $ncount++;
                 } 

                 if($ncount === 1) {

                  echo '</div>';
                  echo '</div>';
                  echo '</div>'; //close out the A-M accordion divs

                  //start the N-Z accordion div
                  echo  '<div class="panel panel-default" style="width:300px">';
                    echo  '<div class="panel-heading" role="tab" id="ViewN-Z" data-toggle="collapse" data-parent="#accordion" data-target="#collapseViewN-Z">';
                      echo '<h2 class="panel-title" style="text-align:center">';
                        echo '<a class="accordion-toggle">';
                          echo 'N-Z';
                        echo '</a>';
                      echo '</h2>';
                    echo '</div>';

                  echo '<div id="collapseViewN-Z" class="panel-collapse collapse" role="tabpanel" aria-labelledby="ViewN-Z">';
                    echo '<div class="panel-body">';

                 }

                 //hard-to-read echo, can break the URL into a query string variable if desired
                 echo '<a href="viewauthor.php?firstname=' . urlencode($row['firstname']) . '&lastname=' . urlencode($row['lastname']) . '"><p class="resultRow"><span class="lastname">' . $row['lastname'] . ',' . ' </span><span class="firstname">' . $row['firstname'] . ' (</span><span class="numOfLetters">' . $row['numOfLetters'] . '</span> letters)</p></a>';
             }

             if ($ncount > 0) { //if we ever even made the n-z div

                  echo '</div>';
                  echo '</div>';
                  echo '</div>'; //close out the N-Z accordion divs
             }

             //in either case, close out the panel-group div
             echo '</div>';

             $dbh = null; //connection closed
         } catch (PDOException $e) {
             print "Error!: " . $e->getMessage() . "<br/>";
             die();
         }

      ?>

   
					<div class="container">
						<article id="main" class="special">
							<header>
								<h2><a href="#">No Sidebar</a></h2>
								<p>
									Morbi convallis lectus malesuada sed fermentum dolore amet
								</p>
							</header>
							<a href="#" class="image featured"><img src="images/pic06.jpg" alt="" /></a>
							<p>
								Commodo id natoque malesuada sollicitudin elit suscipit. Curae suspendisse mauris posuere accumsan massa
								posuere lacus convallis tellus interdum. Amet nullam fringilla nibh nulla convallis ut venenatis purus
								lobortis. Auctor etiam porttitor phasellus tempus cubilia ultrices tempor sagittis. Nisl fermentum
								consequat integer interdum integer purus sapien. Nibh eleifend nulla nascetur pharetra commodo mi augue
								interdum tellus. Ornare cursus augue feugiat sodales velit lorem. Semper elementum ullamcorper lacinia
								natoque aenean scelerisque vel lacinia mollis quam sodales congue.
							</p>
							<section>
								<header>
									<h3>Ultrices tempor sagittis nisl</h3>
								</header>
								<p>
									Nascetur volutpat nibh ullamcorper vivamus at purus. Cursus ultrices porttitor sollicitudin imperdiet
									at pretium tellus in euismod a integer sodales neque. Nibh quis dui quis mattis eget imperdiet venenatis
									feugiat. Neque primis ligula cum erat aenean tristique luctus risus ipsum praesent iaculis. Fermentum elit
									fringilla consequat dis arcu. Pellentesque mus tempor vitae pretium sodales porttitor lacus. Phasellus
									egestas odio nisl duis sociis purus faucibus morbi. Eget massa mus etiam sociis pharetra magna.
								</p>
								<p>
									Eleifend auctor turpis magnis sed porta nisl pretium. Aenean suspendisse nulla eget sed etiam parturient
									orci cursus nibh. Quisque eu nec neque felis laoreet diam morbi egestas. Dignissim cras rutrum consectetur
									ut penatibus fermentum nibh erat malesuada varius.
								</p>
							</section>
							<section>
								<header>
									<h3>Augue euismod feugiat tempus</h3>
								</header>
								<p>
									Pretium tellus in euismod a integer sodales neque. Nibh quis dui quis mattis eget imperdiet venenatis
									feugiat. Neque primis ligula cum erat aenean tristique luctus risus ipsum praesent iaculis. Fermentum elit
									ut nunc urna volutpat donec cubilia commodo risus morbi. Lobortis vestibulum velit malesuada ante
									egestas odio nisl duis sociis purus faucibus morbi. Eget massa mus etiam sociis pharetra magna.
								</p>
							</section>
						</article>
						<hr />
						<div class="row">
							<article class="4u 12u(mobile) special">
								<a href="#" class="image featured"><img src="images/pic07.jpg" alt="" /></a>
								<header>
									<h3><a href="#">Gravida aliquam penatibus</a></h3>
								</header>
								<p>
									Amet nullam fringilla nibh nulla convallis tique ante proin sociis accumsan lobortis. Auctor etiam
									porttitor phasellus tempus cubilia ultrices tempor sagittis. Nisl fermentum consequat integer interdum.
								</p>
							</article>
							<article class="4u 12u(mobile) special">
								<a href="#" class="image featured"><img src="images/pic08.jpg" alt="" /></a>
								<header>
									<h3><a href="#">Sed quis rhoncus placerat</a></h3>
								</header>
								<p>
									Amet nullam fringilla nibh nulla convallis tique ante proin sociis accumsan lobortis. Auctor etiam
									porttitor phasellus tempus cubilia ultrices tempor sagittis. Nisl fermentum consequat integer interdum.
								</p>
							</article>
							<article class="4u 12u(mobile) special">
								<a href="#" class="image featured"><img src="images/pic09.jpg" alt="" /></a>
								<header>
									<h3><a href="#">Magna laoreet et aliquam</a></h3>
								</header>
								<p>
									Amet nullam fringilla nibh nulla convallis tique ante proin sociis accumsan lobortis. Auctor etiam
									porttitor phasellus tempus cubilia ultrices tempor sagittis. Nisl fermentum consequat integer interdum.
								</p>
							</article>
						</div>
					</div>

				</div>

			<!-- Footer -->
				<div id="footer">
					<div class="container">
						<div class="row">

							<!-- Tweets -->
								<section class="4u 12u(mobile)">
									<header>
										<h2 class="icon fa-twitter circled"><span class="label">Tweets</span></h2>
									</header>
									<ul class="divided">
										<li>
											<article class="tweet">
												Amet nullam fringilla nibh nulla convallis tique ante sociis accumsan.
												<span class="timestamp">5 minutes ago</span>
											</article>
										</li>
										<li>
											<article class="tweet">
												Hendrerit rutrum quisque.
												<span class="timestamp">30 minutes ago</span>
											</article>
										</li>
										<li>
											<article class="tweet">
												Curabitur donec nulla massa laoreet nibh. Lorem praesent montes.
												<span class="timestamp">3 hours ago</span>
											</article>
										</li>
										<li>
											<article class="tweet">
												Lacus natoque cras rhoncus curae dignissim ultricies. Convallis orci aliquet.
												<span class="timestamp">5 hours ago</span>
											</article>
										</li>
									</ul>
								</section>

							<!-- Posts -->
								<section class="4u 12u(mobile)">
									<header>
										<h2 class="icon fa-file circled"><span class="label">Posts</span></h2>
									</header>
									<ul class="divided">
										<li>
											<article class="post stub">
												<header>
													<h3><a href="#">Nisl fermentum integer</a></h3>
												</header>
												<span class="timestamp">3 hours ago</span>
											</article>
										</li>
										<li>
											<article class="post stub">
												<header>
													<h3><a href="#">Phasellus portitor lorem</a></h3>
												</header>
												<span class="timestamp">6 hours ago</span>
											</article>
										</li>
										<li>
											<article class="post stub">
												<header>
													<h3><a href="#">Magna tempus consequat</a></h3>
												</header>
												<span class="timestamp">Yesterday</span>
											</article>
										</li>
										<li>
											<article class="post stub">
												<header>
													<h3><a href="#">Feugiat lorem ipsum</a></h3>
												</header>
												<span class="timestamp">2 days ago</span>
											</article>
										</li>
									</ul>
								</section>

							<!-- Photos -->
								<section class="4u 12u(mobile)">
									<header>
										<h2 class="icon fa-camera circled"><span class="label">Photos</span></h2>
									</header>
									<div class="row 25% no-collapse">
										<div class="6u">
											<a href="#" class="image fit"><img src="images/pic10.jpg" alt="" /></a>
										</div>
										<div class="6u">
											<a href="#" class="image fit"><img src="images/pic11.jpg" alt="" /></a>
										</div>
									</div>
									<div class="row 25% no-collapse">
										<div class="6u">
											<a href="#" class="image fit"><img src="images/pic12.jpg" alt="" /></a>
										</div>
										<div class="6u">
											<a href="#" class="image fit"><img src="images/pic13.jpg" alt="" /></a>
										</div>
									</div>
									<div class="row 25% no-collapse">
										<div class="6u">
											<a href="#" class="image fit"><img src="images/pic14.jpg" alt="" /></a>
										</div>
										<div class="6u">
											<a href="#" class="image fit"><img src="images/pic15.jpg" alt="" /></a>
										</div>
									</div>
								</section>

						</div>
						<hr />
						<div class="row">
							<div class="12u">

								<!-- Contact -->
									<section class="contact">
										<header>
											<h3>Nisl turpis nascetur interdum?</h3>
										</header>
										<p>Urna nisl non quis interdum mus ornare ridiculus egestas ridiculus lobortis vivamus tempor aliquet.</p>
										<ul class="icons">
											<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
											<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
											<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
											<li><a href="#" class="icon fa-pinterest"><span class="label">Pinterest</span></a></li>
											<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
											<li><a href="#" class="icon fa-linkedin"><span class="label">Linkedin</span></a></li>
										</ul>
									</section>

								<!-- Copyright -->
									<div class="copyright">
										<ul class="menu">
											<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
										</ul>
									</div>

							</div>

						</div>
					</div>
				</div>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.onvisible.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
		
   <script src="assets/bootstrap/js/bootstrap.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>