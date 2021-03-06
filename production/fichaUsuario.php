<?php
			/*
			Contiene la vista de un usuario. A partir de su nombre (único) realizamos una llamada a la basde de datos para mostrar su información.
			*/
		  $nombreUsuario = $_GET['nombre'];

		
		  include 'dbConect.php';
		  
		  $query = 'SELECT *
					FROM aportaciones where aportaciones.nombre_usuario = "'.$nombreUsuario.'"';
		  
							
		  if( !$result = $db->query($query) ){
			die('There was an error running the query [' . $db->error . ']');
		  }

		  $num_results = $result->num_rows;
					
		 $edicionesTotales = 0;	
		
		   for( $i = 0; $i < $num_results; $i++ ){
				
	
				$row = $result->fetch_object();
				$edicionesTotales =  $edicionesTotales + $row->ediciones ;
		   }
		   

		   if( !$result3 = $db->query($query) ){
			die('There was an error running the query [' . $db->error . ']');
		  }

		  $num_resultsListado3 = $result3->num_rows;
		  
		  $queryLogros = 'SELECT *
					FROM logros where logros.nombre_usuario = "'.$nombreUsuario.'" order by logros.puntos DESC';
		  
							
		  if( !$resultLogros = $db->query($queryLogros) ){
			die('There was an error running the query [' . $db->error . ']');
		  }

		  $num_resultsLogros = $resultLogros->num_rows;
		  

		  
		  $puntosTotales = 0;
		  
		  for( $i = 0; $i < $num_resultsLogros; $i++ ){
				
	
				$rowLogros = $resultLogros->fetch_object();
				$puntosTotales =  $puntosTotales + $rowLogros->puntos ;
		   }
		  
		 ?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Colstats: User <?php echo $nombreUsuario?></title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/icheck/flat/green.css" rel="stylesheet">


    <script src="js/jquery.min.js"></script>
<link rel="icon" href="images/logoTFG.png">
	<style>
	h2,h3, #userName{
	
		font-family: 'Montserrat Alternates', sans-serif;
	}
	
	.DTTT_button{
		
		display:none;
		
	}
	</style>
	
	
</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <?php
				include'menuLateral.php';
			?>

            <!-- top navigation -->
            <div class="top_nav">

                <?php
				include'barraSuperior.php';
				?>

            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">

                <div class="">
                    

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">

									<div class="row top_tiles">
										<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
											<div style="border:0px;" class="tile-stats">
												
												<div class="avatar-view" style=" float:left; width: 90px;border-radius: 50%;height: auto;"">
																	<img src="<?php echo''.$row->url_avatar.'' ?>" alt="Avatar">
												 </div>
												
												<h3 style="margin-top:20px;margin-left:100px; font-size: 15px;color: #34495E;" ><i class="fa fa-cube"></i> <?php  echo''.$nombreUsuario.''; ?></h3>
													<p style="margin-left:100px; "></p>
											</div>
										</div>
										<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
											<div class="tile-stats">
												<div class="icon"><i class="fa fa-bar-chart"style="font-size: 55px;"></i>
												</div>
												<div style="font-size:25px; font-family: 'Orbitron', sans-serif;" class="count"> <?php  echo''.$edicionesTotales.''; ?></div>

												<h3>Editions</h3>
												<p>Global recently editions.</p>
											</div>
										</div>
										<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
											<div class="tile-stats">
												<div class="icon"><i class="fa fa-trophy" style="font-size: 55px;"></i>
												</div>
												<div style="font-size:25px; font-family: 'Orbitron', sans-serif;" class="count"><?php  echo''.$puntosTotales.''; ?></div>

												<h3>Points</h3>
												<p>Total Table Leader points earned.</p>
											</div>
										</div>
										<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
											<div class="tile-stats">
												<div class="icon"><i class="fa fa-cubes" style="font-size: 55px;"></i>
												</div>
												<div style="font-size:25px; font-family: 'Orbitron', sans-serif;" class="count"><?php  echo''.$num_results.''; ?></div>

												<h3>Wikis</h3>
												<p>Total wikis participating now.</p>
											</div>
										</div>
									</div>
                                   
                                    
                                </div>
								</div>
                                
								
									<div class="x_panel">
													<div class="x_title">
														<h2><i class="fa fa-bars"></i> Number of editions in each wiki <small>Editions per Wiki</small></h2>
														<button style="float:right;" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal8"><i class="fa fa-info"></i> Info</button>

														<div class="clearfix"></div>
													</div>
													<div class="x_content">

														<div id="mainb" style="height:350px;"></div>

													</div>
									</div>
			
                                    <div class="col-md-6 col-sm-6 col-xs-12 profile_left">
										
										<div class="x_panel">
											<div class="x_title">
												<h2><i class="fa fa-bars"></i> Participations per year</h2>
												<button style="float:right;" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal7"><i class="fa fa-info"></i> Info</button>
												<div class="clearfix"></div>
											</div>
											<div class="x_content">

												<div id="echart_donut3" style="height:350px;"></div>

											</div>
										</div>
										</div>
									<div class="col-md-6 col-sm-6 col-xs-12 profile_left">
										<div class="x_panel">
											<div class="x_title">
												<h2><i class="fa fa-bars"></i> Participations porcent in wikis</h2>
												<button style="float:right;" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModa20"><i class="fa fa-info"></i> Info</button>
												<div class="clearfix"></div>
											</div>
											<div class="x_content">

												<div id="echart_donut" style="height:350px;"></div>

											</div>
										</div>
										
										
										

                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        
										<div class="x_panel">		
							<button style="float:right;" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal9"><i class="fa fa-info"></i> Info</button>
	

                                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">User Participations Table</a>
                                                </li>
                                                <!--<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Last User Badges (Esto se borrara)</a>
                                                </li>-->
                                                <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">Last User Badges</a>
                                                </li>
												
												
												
                                            </ul>
                                            <div id="myTabContent" class="tab-content">
                                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                                                  
												
												
												

														<div class="col-md-12 col-sm-12 col-xs-12">
															<div class="x_panel">
																<div class="x_title">
																	<!--<h2>Activity</h2>-->
																	
																	<div class="clearfix"></div>
																</div>
																
																<div class="x_content">
																	<table id="example" class="table table-striped responsive-utilities jambo_table">
																		<thead>
																			<tr class="headings">
																				 <th>Wiki Aportation</th>
																				 <th>Graphic</th>
																				<th class=" no-link last"><span class="nobr">Editions</span>
																				<th>Start date</th>
																				<th>Wiki Profile</th>
																				</th>
																			</tr>

																		<tbody>
																			
																			<?php
																			  if( !$result4 = $db->query($query) ){
																				die('There was an error running the query [' . $db->error . ']');
																			  }

																			  $num_resultsListado4 = $result4->num_rows;
																			
																			 for( $i = 1; $i <= $num_resultsListado4; $i++ ){

																		
																				$row4 = $result4->fetch_object();
																				
																				$queryWiki = 'SELECT * FROM wikis where wikis.id_wiki = "'.$row4->id_wiki.'"';

																				 if( !$resultWiki = $db->query($queryWiki) ){
																					die('There was an error running the query [' . $db->error . ']');
																				  }

																				  $rowWiki = $resultWiki->fetch_object();
																					
																					$grafico = $row4->ediciones / 30;
																			
																		   echo' <tr class="even pointer">
																			   
																				
																				<td class=" last"><a href="fichaWiki.php?id='.$rowWiki->id_wiki.'">'.$rowWiki->nombre_wiki.' </td>
																				<td ><div class="progress progress_sm">										
																								<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="'.$grafico.'"></div>
																								
																					</div>
																					
																				</td>
																				<td class=" ">'.$row4->ediciones.' Editions</td>
																				<td class=" ">'.$row4->fecha_inicio.'</td>
																				
																				<td class=" "><a href="fichaWiki.php?id='.$rowWiki->id_wiki.'"> <button style="width:100%;" type="button" class="btn btn-success btn-xs"><i class="fa fa-user"></i> Acess To Wiki </button></a></td>
																			</tr>';
																			 
																			 }
																			?>
																			
																		</tbody>

																	</table>
																</div>
															</div>
														</div>

														<br/>
														<br/>
														<br/>

												
												

                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

													
													<div class="x_panel">
													
													<div class="x_title">
																	<h2>Last User Badges <small>Complete description</small></h2>
																	
																	<div class="clearfix"></div>
																</div>

                                            

                                            <!-- end of user messages -->
                                            <ul class="messages">
                                                
												<?php
												if( !$resultLogros = $db->query($queryLogros) ){
													die('There was an error running the query [' . $db->error . ']');
												  }

												  $num_resultsLogros = $resultLogros->num_rows;
												  
												  for( $i = 1; $i <= $num_resultsLogros; $i++ ){

												
														$rowLogros = $resultLogros->fetch_object();
												
												
												echo' <li>
                                                 
													<img style="      height: 48px; width: 48px;  border-radius: 50%;" src="'.$rowLogros->url_imagen_logro.'" class="avatar" alt="Avatar">
                                                    <div class="message_date">
                                                        <img style="    border-radius: 50%;" src="'.$rowLogros->url_avatar_usuario.'" class="avatar" alt="Avatar">
                                                        <p class="month">Badge</p>
                                                    </div>
                                                    <div class="message_wrapper">
                                                        <h4 class="heading">'.$rowLogros->titulo_logro.'</h4>
                                                        <blockquote class="message">'.$rowLogros->descripcion_logro.'.</blockquote>
                                                        <br />
                                                        <p class="url">
                                                            <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                                            <a href="#"><i class="fa fa-paperclip"></i> More Information </a>
                                                        </p>
                                                    </div>
                                                </li>';
												}
												?>
                                            </ul>
                                            <!-- end of user messages -->
											

                                        </div>

                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                                    
													<div class="row">
														<div class="col-md-12">
															<div class="x_panel">
																<div class="x_content">

																	<div class="row">
																		<?php
																		
																		
																		if( !$resultLogros = $db->query($queryLogros) ){
																			die('There was an error running the query [' . $db->error . ']');
																		  }

																		  $num_resultsLogros = $resultLogros->num_rows;
																		  
																		  for( $i = 1; $i <= $num_resultsLogros; $i++ ){

																		
																				$rowLogros = $resultLogros->fetch_object();
																		  
																				$queryNombreWiki = 'SELECT nombre_wiki
																							FROM wikis where wikis.id_wiki = "'.$rowLogros->id_wiki.'"';
																				  
																									
																				  if( !$resultNombreWiki = $db->query($queryNombreWiki) ){
																					die('There was an error running the query [' . $db->error . ']');
																				  }

																				  $rowNombreWiki = $resultNombreWiki->fetch_object();

																		 echo'
																																	
																		<div class="col-md-4 col-sm-4 col-xs-12 animated fadeInDown" >
																			<div class="well profile_view">
																				<div class="col-sm-12" style="    min-height: 300px; height: 190px;">
																					
																					<div class="left col-xs-7">
																						
																						<h2>'.$rowLogros->titulo_logro.'</h2>
																						<img style="height: 60px;width: 60px;margin: 5px 10px 5px 0;border-radius: 50%;" src="'.$rowLogros->url_avatar_usuario.'" class="avatar" alt="Avatar">
																						<p><strong>Wiki: </strong><a href="fichaWiki.php?id='.$rowLogros->id_wiki.'"> '.$rowNombreWiki->nombre_wiki.' </a></p>
																						<br>
																						<p><strong>Description: </strong>'.$rowLogros->descripcion_logro.'.</p>
																						</br>
																					</div>
																					<div class="right col-xs-5 text-center">
																						<img src="'.$rowLogros->url_imagen_logro.'" alt="" class="img-circle img-responsive">
																					</div>
																				</div>
																				<div style="margin-top: 0px;"  class="col-xs-12 bottom text-center">
																					<div class="col-xs-12 col-sm-6 emphasis">
																						<p class="ratings">
																							'.$rowLogros->puntos.'
																							<span class="fa fa-trophy"></span>
																							
																						</p>
																					</div>
																					<div class="col-xs-12 col-sm-6 emphasis">
																						<!--<button type="button" class="btn btn-success btn-xs"><i class="fa fa-comments-o"></i> Globals</button>-->
																						<a href="fichaWiki.php?id='.$rowLogros->id_wiki.'" ><button  type="button" class="btn btn-primary btn-xs"> <i class="fa fa-user">
																							</i> Acess to Wiki</button></a>
																					</div>
																				</div>
																			</div>
																		</div>';
																		  }
																		?>

																		
																	</div>

																</div>
															</div>
														</div>
													</div>													
												
												</div>
												
												
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							<!-- Start modals -->
							
							  <div id="myModal7" class="modal fade bs-example-modal-lg" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close"><span aria-hidden="true">×</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bars"></i>Information about the panel</h4>
                                        </div>
                                        <div class="x_content" style="background-image:url(images/ChartPanelPopup1.jpg); height:140px;">
                                            <h1 style="color:white; position:relative;   left: 4%; top: 30%;">Participations per year</h1>
                                        </div>
                                        <div class="modal-body">
                                            <div style="padding:25px;">
                                                <p style=" text-align:justify;     margin-top: 15%;">
                                                    This graph shows the number of wikis edited by this user.
                                                    <br>
                                                </p>
                                                <p style=" text-align:justify;">
												The X axis displays the year (since the moment the user started editing) and the Y axis the number of wikis.<br>
                                                The tooltip bar contains:<br>
                                                ─ <b>Refresh</b> returns to the initial state.<br>
                                                ─ <b>Save image</b> saves the graph in PNG format.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
							  <div id="myModal8" class="modal fade bs-example-modal-lg" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close"><span aria-hidden="true">×</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bars"></i>Information about the panel</h4>
                                        </div>
                                        <div class="x_content" style="background-image:url(images/ChartPanelPopup1.jpg); height:140px;">
                                            <h1 style="color:white; position:relative;   left: 4%; top: 30%;">Editions per Wiki</h1>
                                        </div>
                                        <div class="modal-body">
                                            <div style="padding:25px;">
                                                <p style=" text-align:justify;     margin-top: 15%;">
                                                    The graph shows the number of editions for each one of the wikis in which the user participates.
                                                    <br><br>
                                                </p>
                                                <p style=" text-align:justify;">
                                                The X axis displays the wikis and the Y axis the total number of editions.<br>
												The tooltip bar contains:<br>
												─ <b>Refresh</b> returns to the initial state.<br>
												─ <b>Save image</b> saves the graph in PNG format.
												</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
							  <div id="myModal9" class="modal fade bs-example-modal-lg" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close"><span aria-hidden="true">×</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bars"></i>Information about the panel</h4>
                                        </div>
                                        <div class="x_content" style="background-image:url(images/ChartPanelPopup1.jpg); height:140px;">
                                            <h1 style="color:white; position:relative;   left: 4%; top: 30%;">User's information</h1>
                                        </div>
                                        <div class="modal-body">
                                            <div style="padding:25px;">
                                                <p style=" text-align:justify;     margin-top: 15%;">
													This table divides its contents into 2 tabs: 
													<br>
                                                </p>
                                                <p style=" text-align:justify;">
                                                ─ <b>User Participation</b>: displays the number of editions, the date of the first edition and the access to the wiki profile, per wiki.<br>
												─ <b>Last Badge</b>: displays the user's last badge, per wiki.<br> 
												</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
							  <div id="myModa20" class="modal fade bs-example-modal-lg" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close"><span aria-hidden="true">×</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bars"></i>Information about the panel</h4>
                                        </div>
                                        <div class="x_content" style="background-image:url(images/ChartPanelPopup1.jpg); height:140px;">
                                            <h1 style="color:white; position:relative;   left: 4%; top: 30%;">Wikis' Participation</h1>
                                        </div>
                                        <div class="modal-body">
                                            <div style="padding:25px;">
                                                <p style=" text-align:justify;     margin-top: 15%;">
                                                    This graph shows the user's participation (percentage) per wiki.
                                                    <br>
                                                </p>
                                                <p style=" text-align:justify;">
                                                    The tooltip bar contains:<br>
													─ <b>Refresh</b> returns to the initial state.<br>
													─ <b>Save image</b> saves the graph in PNG format.
												</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>							
							<!-- end modals-->
							
							
                        </div>
                    </div>
                </div>

                <!-- footer content -->
               <?php
						include'footer.php';
					?>	
                <!-- /footer content -->

            </div>
			
			
			
				
				<!-- Datatables -->
        <script src="js/datatables/js/jquery.dataTables.js"></script>
        <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>
        <script>
            $(document).ready(function () {
                $('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });

            var asInitVals = new Array();
            $(document).ready(function () {
                var oTable = $('#example').dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns: "
                    },
                    "aoColumnDefs": [
                        {
                            'bSortable': false,
                            'aTargets': [0]
                        } //disables sorting for column one
            ],
                    'iDisplayLength': 12,
                    "sPaginationType": "full_numbers",
                    "dom": 'T<"clear">lfrtip',
                    "tableTools": {
                        "sSwfPath": ""
                    }
                });
                $("tfoot input").keyup(function () {
                    /* Filter on the column based on the index of this element's parent <th> */
                    oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
                });
                $("tfoot input").each(function (i) {
                    asInitVals[i] = this.value;
                });
                $("tfoot input").focus(function () {
                    if (this.className == "search_init") {
                        this.className = "";
                        this.value = "";
                    }
                });
                $("tfoot input").blur(function (i) {
                    if (this.value == "") {
                        this.className = "search_init";
                        this.value = asInitVals[$("tfoot input").index(this)];
                    }
                });
            });
        </script>
            <!-- /page content -->
        </div>
		
    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="js/icheck/icheck.min.js"></script>

    <script src="js/custom.js"></script>

    <!-- image cropping -->
    <script src="js/cropping/cropper.min.js"></script>
    <script src="js/cropping/main.js"></script>

    
    <!-- daterangepicker -->
    <script type="text/javascript" src="js/moment.min.js"></script>
    <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
    <!-- moris js -->
    <script src="js/moris/raphael-min.js"></script>
    <script src="js/moris/morris.js"></script>
	<script src="js/echart/echarts-all.js"></script>
    <script src="js/echart/green.js"></script>
	
	<script>
	
	
		
	
        var myChart9 = echarts.init(document.getElementById('mainb'), theme);
        myChart9.setOption({
            title : {
       // text: 'User info',
      //  subtext: 'Wikia'
    },
    tooltip : {
        trigger: 'axis'
    },
   /* legend: {
		x: 'center',
        y: 'bottom',
         data: ['Line', 'Bar', 'Scatter', 'K', 'Pie', 'Radar', 'Chord', 'Force', 'Map', 'Gauge', 'Funnel']	
    },*/
    toolbox: {
        show : true,
        feature : {
           // mark : {show: true},
           // dataView : {show: true, readOnly: false},
            //magicType : {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    xAxis : [
        {
            type : 'category',
			show: false,
            data : [
			
			<?php
			
			 $query = 'SELECT *
					FROM aportaciones where aportaciones.nombre_usuario = "'.$nombreUsuario.'" ORDER BY aportaciones.ediciones DESC LIMIT 12';
					
					 if( !$result1 = $db->query($query) ){
			die('There was an error running the query [' . $db->error . ']');
		  }

		  $num_resultsListado1 = $result1->num_rows;
			
			 for( $i = 1; $i <= $num_resultsListado1; $i++ ){
				 
				
				  $row1 = $result1->fetch_object();
			
				  $queryWiki = 'SELECT * FROM wikis where wikis.id_wiki = "'.$row1->id_wiki.'"';
				  
				  if( !$resultWiki = $db->query($queryWiki) ){
					die('There was an error running the query [' . $db->error . ']');
				  }

				  $rowWiki = $resultWiki->fetch_object();
			

				echo'"'.$rowWiki->nombre_wiki.'",';

			 } //End For
			 
					echo'"';
					echo'Other Wikis';
					echo'"';			 
			 
			?>
			
			]
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
	
	
		{
            name:'Editions',
            type:'bar',
			 itemStyle: {
                normal: {
                    color: function(params) {
                        // build a color map as your need.
                        var colorList = [
                          '#673147','#BDC3C7','#34495E','#402629','#26C0C0', '#27727B',
                           '#FE8463','#E5C964', '#A62029' ,'#915D8E','#F3A43B',
                           '#D7504B','#C6E579'
                        ];
                        return colorList[params.dataIndex]
                    },
                    label: {
                        show: true,
                        position: 'top',
                        formatter: '{b}\n{c}'
                    }
                }
            },
            data:[
			<?php
			
				if( !$result2 = $db->query($query) ){
				die('There was an error running the query [' . $db->error . ']');
			  }

			  $num_resultsListado2 = $result2->num_rows;
			$restarTotal=0;
			 for( $i = 1; $i <= $num_resultsListado2; $i++ ){
				 
				$row2 = $result2->fetch_object();
				
				$restarTotal = $restarTotal + $row2->ediciones;
				echo'"'.$row2->ediciones.'",';

				
			 }
			 
					//Aquí va el dato de Other wikis.

			$query4 =  'SELECT SUM(ediciones) as `asd` from `aportaciones` where aportaciones.nombre_usuario = "'.$nombreUsuario.'" ';
							
						if( !$result4 = $db->query($query4) ){
						die('There was an error running the query [' . $db->error . ']');
					  }
					  
						 $row4 = $result4->fetch_object();
						 $numeroExacto = $row4->asd - $restarTotal;
						echo' {
							 value: '.$numeroExacto.',
							 name: "Other Wikis"
						 },';
					
					//Funciona					
					
			?>
			
			],
			markPoint: {
                tooltip: {
                    trigger: 'item',
                    backgroundColor: 'rgba(0,0,0,0)',
                    formatter: function(params){
                        return '<img src="' 
                                + params.data.symbol.replace('image://', '')
                                + '"/>';
                    }
				},
				 data: [
				 <?php
			
			 $query = 'SELECT *
					FROM aportaciones where aportaciones.nombre_usuario = "'.$nombreUsuario.'" ORDER BY aportaciones.ediciones DESC ';
					
					 if( !$result1 = $db->query($query) ){
			die('There was an error running the query [' . $db->error . ']');
		  }

		  $num_resultsListado1 = $result1->num_rows;
			
			 for( $i = 1; $i <= $num_resultsListado1; $i++ ){
				 
				  $ii = $i -1;
				  $row1 = $result1->fetch_object();
			
				  $queryWiki = 'SELECT * FROM wikis where wikis.id_wiki = "'.$row1->id_wiki.'" LIMIT 1';
				  
				  if( !$resultWiki = $db->query($queryWiki) ){
					die('There was an error running the query [' . $db->error . ']');
				  }

				  $rowWiki = $resultWiki->fetch_object();
			
				//echo'{xAxis:'.$ii.', y: 320, name:"'.$rowWiki->nombre_wiki.'", symbolSize:30, symbol: "'.$rowWiki->url_imagen_wiki.'"},';
				//'/*'.$rowWiki->url_imagen_wiki.'*/'

			 }
			?>
				 
		
                ]
			}
			
        }
		
	
    ]
});



var myChart = echarts.init(document.getElementById('echart_donut'), theme);
        myChart.setOption({
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            calculable: true,
            color:['#673147','#BDC3C7','#34495E','#402629','#26C0C0', '#27727B',
                           '#FE8463','#E5C964', '#A62029' ,'#915D8E','#F3A43B',
                           '#D7504B','#C6E579'],
			legend: {
                //orient: 'vertical',
                //x: 'left',
                x: 'center',
                y: 'bottom',
                data: [
				
				<?php
			
				 $query = 'SELECT *
					FROM aportaciones where aportaciones.nombre_usuario = "'.$nombreUsuario.'" order by aportaciones.ediciones DESC LIMIT 12';
			
				if( !$result5 = $db->query($query) ){
				die('There was an error running the query [' . $db->error . ']');
			  }

			  $num_resultsListado5 = $result5->num_rows;
			
			 for( $i = 1; $i <= $num_resultsListado5; $i++ ){
				$row5 = $result5->fetch_object();
				
				 $queryWiki = 'SELECT * FROM wikis where wikis.id_wiki = "'.$row5->id_wiki.'"';
				  
				  if( !$resultWiki = $db->query($queryWiki) ){
					die('There was an error running the query [' . $db->error . ']');
				  }

				  $rowWiki = $resultWiki->fetch_object();
				
				//if ($i != $num_resultsListado5)
				echo'"'.$rowWiki->nombre_wiki.'",';
				/*else{
					echo'"';
					echo''.$rowWiki->nombre_wiki.'';
					echo'"';
				}*/
				
			 }
				echo "'Other Wikis'";
			 

			 
			 
			?>
				
				
				
				]
            },
            toolbox: {
                show: true,
                feature: {
                   /* magicType: {
                        show: true,
                        type: ['pie', 'funnel'],
                        option: {
                            funnel: {
                                x: '25%',
                                width: '50%',
                                funnelAlign: 'center',
                                max: 5048
                            }
                        }
                    },*/
                    restore: {
                        show: true
                    },
                    saveAsImage: {
                        show: true
                    }
                }
            },
            series: [
                {
                    name: 'User Editions',
                    type: 'pie',
                    radius: ['35%', '55%'],
                    itemStyle: {
                        normal: {
                            label: {
                                show: true
                            },
                            labelLine: {
                                show: true
                            }
                        },
                        emphasis: {
                            label: {
                                show: true,
                                position: 'center',
                                textStyle: {
                                    fontSize: '14',
                                    fontWeight: 'normal'
                                }
                            }
                        }
                    },
                    data: [
                        
							
							<?php
			
				if( !$result5 = $db->query($query) ){
				die('There was an error running the query [' . $db->error . ']');
			  }

			  $num_resultsListado5 = $result5->num_rows;
			$restarTotal = 0;
			 for( $i = 1; $i <= $num_resultsListado5; $i++ ){
				$row5 = $result5->fetch_object();
				

				$queryWiki = 'SELECT * FROM wikis where wikis.id_wiki = "'.$row5->id_wiki.'"';
				  
				  if( !$resultWiki = $db->query($queryWiki) ){
					die('There was an error running the query [' . $db->error . ']');
				  }

				  $rowWiki = $resultWiki->fetch_object();
				$restarTotal = $restarTotal + $row5->ediciones;
				echo'{';
				echo' value: '.$row5->ediciones.',
                            name: "'.$rowWiki->nombre_wiki.'" },';
				
				
			 }
			 
			 $query4 =  'SELECT SUM(ediciones) as `asd` from `aportaciones` where aportaciones.nombre_usuario = "'.$nombreUsuario.'" ';
							
						if( !$result4 = $db->query($query4) ){
						die('There was an error running the query [' . $db->error . ']');
					  }
					  
						 $row4 = $result4->fetch_object();
						 $numeroExacto = $row4->asd - $restarTotal;
					
					if($numeroExacto != 0){
					echo' {
							 value: '.$numeroExacto.',
							 name: "Other Wikis"
						 },';
				}
			?>
   
                        
                ]
            }
        ]
        });
		
		</script>
		
		<?php
		
		$query = 'SELECT *
					FROM aportaciones where aportaciones.nombre_usuario = "'.$nombreUsuario.'"';
		  
							
		  if( !$result = $db->query($query) ){
			die('There was an error running the query [' . $db->error . ']');
		  }

		  $num_results = $result->num_rows;
					
			
		 $contador2007 = 0;
		 
		 $contador2008 = 0;
		
		 $contador2009 = 0;
		 
		 $contador2010 = 0;
		 
		 $contador2011= 0;
		
		 $contador2012 = 0;
		 
		 $contador2013 = 0;
		
		 $contador2014 = 0;
		 
		 $contador2015 = 0;
		
		 $contador2016 = 0;
		 
		
		   for( $i = 0; $i < $num_results; $i++ ){
				
				$row = $result->fetch_object();
				
				$coincidencia2007 = strpos($row->fecha_inicio, "2007");
				$coincidencia2008 = strpos($row->fecha_inicio, "2008");
				$coincidencia2009 = strpos($row->fecha_inicio, "2009");
				$coincidencia2010 = strpos($row->fecha_inicio, "2010");
				$coincidencia2011 = strpos($row->fecha_inicio, "2011");
				$coincidencia2012 = strpos($row->fecha_inicio, "2012");
				$coincidencia2013 = strpos($row->fecha_inicio, "2013");
				$coincidencia2014 = strpos($row->fecha_inicio, "2014");
				$coincidencia2015 = strpos($row->fecha_inicio, "2015");
				$coincidencia2016 = strpos($row->fecha_inicio, "2016");
				
				
				
				if($coincidencia2007 == true)
					$contador2007 = $contador2007 +1;
				
				if($coincidencia2008 == true)
					$contador2008 = $contador2008 +1;
				
				if($coincidencia2009 == true)
					$contador2009 = $contador2009 +1;
				
				if($coincidencia2010 == true)
					$contador2010 = $contador2010 +1;
				
				if($coincidencia2011 == true)
					$contador2011 = $contador2011 +1;
				
				if($coincidencia2012 == true)
					$contador2012 = $contador2012 +1;
				
				if($coincidencia2013 == true)
					$contador2013 = $contador2013 +1;
				
				if($coincidencia2014 == true)
					$contador2014 = $contador2014 +1;
				
				if($coincidencia2015 == true)
					$contador2015 = $contador2015 +1;
				
				if($coincidencia2016 == true)
					$contador2016 = $contador2016 +1;
				
		   }
		
		?>
		

		<script>
		var myChart10 = echarts.init(document.getElementById('echart_donut3'), theme);
        myChart10.setOption({
		  
   
    tooltip : {
        trigger: 'axis'
    },
    legend: {
      //  orient : 'vertical',
      //  x : 'right',
      //  y : 'bottom',
        data:['Number the Wikis edited for <?php echo''.$row->nombre_usuario.''; ?> over time']
    },
    toolbox: {
        show : true,
        feature : {
           // mark : {show: true},
           // dataView : {show: true, readOnly: false},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
	    xAxis : [
        {
            type : 'category',
			boundaryGap : false,
            data : ['2007','2008','2009','2010','2011','2012','2013','2014','2015','2016']
			//['2016','2015','2014','2013','2012','2011','2010','2009','2008','2007']
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
	
    calculable : true,
    series : [
        {
            name: 'Number the Wikis edited for <?php echo''.$row->nombre_usuario.''; ?> over time',
            type: 'line',
			 itemStyle: {normal: {areaStyle: {type: 'default'}}},
            data : [<?php echo''.$contador2007.'';?>, <?php echo''.$contador2008.'';?>, <?php echo''.$contador2009.'';?>, <?php echo''.$contador2010.'';?>, <?php echo''.$contador2011.'';?>, <?php echo''.$contador2012.'';?>,<?php echo''.$contador2013.'';?>, <?php echo''.$contador2014.'';?>, <?php echo''.$contador2015.'';?>,<?php echo''.$contador2016.'';?>],
               //<?php echo''.$contador2016.''; ?>, <?php echo''.$contador2015.''; ?>, <?php echo''.$contador2014.''; ?>, <?php echo''.$contador2013.''; ?>, <?php echo''.$contador2012.''; ?>, <?php echo''.$contador2011.''; ?>, <?php echo''.$contador2010.''; ?>,<?php echo''.$contador2009.''; ?>, <?php echo''.$contador2008.''; ?>, <?php echo''.$contador2007.''; ?>],
         }
                 
            ]
        
    
});
</script>

<script>

var myChart = echarts.init(document.getElementById('EdicionesPuntos'), theme);
        myChart.setOption({
			
    tooltip : {
        trigger: 'axis',
        axisPointer : {            
            type : 'shadow'        
        }
    },
    legend: {
		 x: 'center',
         y: 'bottom',
        data:['Ediciones', 'Logros']
    },
    toolbox: {
        show : true,
        feature : {
            
            dataView : {show: true, readOnly: false},
            magicType : {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    xAxis : [
        {
            type : 'value'
        }
    ],
    yAxis : [
        {
            type : 'category',
            axisTick : {show: false},
            data : [
			
			<?php
			
				if( !$result5 = $db->query($query) ){
				die('There was an error running the query [' . $db->error . ']');
			  }

			  $num_resultsListado5 = $result5->num_rows;
			
			 for( $i = 1; $i <= $num_resultsListado5; $i++ ){
				$row5 = $result5->fetch_object();
				
				if ($i != $num_resultsListado5)
				echo'"'.$row5->ediciones.'",';
				else{
					echo'"';
					echo''.$row5->ediciones.'';
					echo'"';
				}
				
			 }
			?>
			
			
			]
        }
    ],
    series : [
        {
            name:'Ediciones',
            type:'bar',
            itemStyle : { normal: {label : {show: true, position: 'inside'}}},
            data:[
			
			<?php
			
				if( !$result5 = $db->query($query) ){
				die('There was an error running the query [' . $db->error . ']');
			  }

			  $num_resultsListado5 = $result5->num_rows;
			
			 for( $i = 1; $i <= $num_resultsListado5; $i++ ){
				$row5 = $result5->fetch_object();
				echo'{';
				echo' value: '.$row5->ediciones.',
                            name: "'.$row5->ediciones.'" },';
				
				
			 }
			?>
			
			]
        },
        {
            name:'Logros',
            type:'bar',
            stack: 'Análisis',
            barWidth : 5,
            itemStyle: {normal: {
                label : {show: true}
            }},
            data:[
			
			<?php
			
				if( !$result5 = $db->query($query) ){
				die('There was an error running the query [' . $db->error . ']');
			  }

			  $num_resultsListado5 = $result5->num_rows;
			
			 for( $i = 1; $i <= $num_resultsListado5; $i++ ){
				$row5 = $result5->fetch_object();
				echo'{';
				echo' value: '.$row5->ediciones.',
                            name: "'.$row5->ediciones.'" },';
				
				
			 }
			?>
			
			]
        }
    ]
});




	</script>
  
 
			

	
    <!-- /datepicker -->
</body>

</html>