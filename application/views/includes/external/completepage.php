
                                <!-- HEADER -->
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Avaleea 2</title>
		<link rel="shortcut icon" href="img/symbol.png" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">    

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
 
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

		<link rel="stylesheet" href="css/estilo.css">		
</head>

<body>
  <div class="container-fluid">

    <div class="row">
        <nav class="navbar fixed-top navbar-expand-md navbar-light bg-primary">
            <a class="navbar-brand ml-3" href="#">
            <img src="img/symbol.png" width="40" height="40" alt="" class="mb-1 mr-3">				
            <span class="h3" style="font-family: 'Comic Sans MS'; color: #fff;">Avaleea</span> 
            <span class="h6" style="color: #ffff60;">Test Maker</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsavaleea" aria-controls="navbarsavaleea" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse ml-1 px-5" id="navbarsavaleea">
                <ul class="navbar-nav mr-auto h5 px-5" style="margin-left: 50px; padding: 0 10px;">
                    <li class="nav-item active mx-3">
                    <a class="nav-link" style="color: #fff;" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item mx-3">
                    <a class="nav-link" style="color: #fff;" href="#">Questions</a>
                    </li>
                    <li class="nav-item mx-3">
                    <a class="nav-link" style="color: #fff;" href="#">Tests</a>
                    </li>
                    <li class="nav-item dropdown mx-3">
                    <a class="nav-link dropdown-toggle" style="color: #fff;" href="http://example.com" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sign in</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" style="color: #000;" href="#">Login</a>
                        <a class="dropdown-item" style="color: #000;" href="#">Logout</a>
                        <a class="dropdown-item" style="color: #000;" href="#">Sign Up</a>
                    </div>
                    </li>
                </ul>

                <form class="form-inline my-2 my-md-0" method="GET" action="http://www.google.com/search" style="margin-right: -50px;">
                    <input type="hidden" name="sitesearch" value="http://localhost/desenv/bootstrap4/bootstrap-4-rev-2-master/">
                    <input class="form-control" type="text" placeholder="type here">
                    <input type="submit" value="Search" class="btn btn-light ml-1">
                </form>
                
            </div>
        </nav>
    </div>  <!-- End .row -->
                            	<!-- End HEADER -->


                                <!-- PRINCIPAL -->
    <div class="container">

      <div class="row wrapper text-center d-flex justify-content-center align-items-start mt-5">
        <div class="row" style="margin-top: 30px;">  <!-- Functions new, view, save, save & new -->
        
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="col-3">
                  <div class="btn-group btn-group-md ml-2 mr-1" role="group" aria-label="First group">
                    <a href="http://localhost/desenv/bootstrap4/bootstrap-4-rev-2-master/pesa.php" class="btn btn-outline-info" id="btn-new" name="btn-new">
                        <i class="ion ion-android-add-circle"></i>
                        New question
                    </a>
                  </div>
                </div>
                <div class="col-2">
                  <div class="btn-group btn-group-md ml-2 mr-2" role="group" aria-label="Second group">
                    <button type="button" class="btn btn-outline-info" id="btn-preview" name="btn-preview">
                        <i class="ion ion-ios-eye"></i>
                        Preview
                    </button>
                  </div>
                </div>
                <div class="col-2">
                  <div class="btn-group btn-group-md ml-4 mr-2" role="group" aria-label="Third group">
                    <button type="button" class="btn btn-outline-info" id="btn-save" name="btn-save">
                        <i class="ion ion-android-checkbox"></i>
                        Save
                    </button>
                  </div>
                </div>
                <div class="col-3">
                  <div class="btn-group btn-group-md ml-3 mr-2" role="group" aria-label="Fourth group">
                    <button type="button" class="btn btn-outline-info" id="btn-save-new" name="btn-save-new">
                        <i class="ion ion-android-checkbox"></i>
                        <i class="ion ion-android-add-circle"></i>
                        Save & New
                    </button>
                  </div>
                </div>
                <div class="col-2">
                  <div class="btn-group btn-group-md ml-3 mr-2" role="group" aria-label="Fifth group">
                    <button type="button" class="btn btn-outline-info" id="btn-send" name="btn-send">
                        <i class="ion ion-paper-airplane"></i>
                        Send
                    </button>
                  </div>
                </div>
                
            </div>				
        
        </div>	<!-- end Functions -->										
      </div>	<!-- end Wrapper -->

    
    <div class="row mt-1" style="border: 2px ridge #007BFF;"> </div>  <!-- HR -->			


    <div class="row text-center d-flex justify-content-center align-items-start my-3">  <!-- select Type Questions -->
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
          <label class="btn btn-primary active mx-2" name="lbl-mc" id="lbl-mc">
            <input type="radio" name="options" id="optionMC" autocomplete="off">
            <i class="ion ion-ios-list-outline"></i>
            multiple choice
          </label>
          <label class="btn btn-primary mx-2" name="lbl-tf" id="lbl-tf">
            <input type="radio" name="options" id="optionTF" autocomplete="off"> 
            <i class="ion ion-compose"></i>
            true and false
          </label>
          <label class="btn btn-primary mx-2" name="lbl-fg" id="lbl-fg">
            <input type="radio" name="options" id="optionFG" autocomplete="off"> 
            <i class="ion ion-ios-settings-strong"></i>
            fill in the gaps
          </label>
          <label class="btn btn-primary mx-2" name="lbl-sq" id="lbl-sq">
            <input type="radio" name="options" id="optionSQ" autocomplete="off"> 
            <i class="ion ion-edit"></i>
            subjective question
          </label>
        </div>			
    </div>		  
    <!-- end select Type Questions -->

    
    <!-- input enunciation question -->
    <div class="row text-center d-flex justify-content-center align-items-start my-5">
        <div class="col-offset-1 col-2" style="border: 0 solid #c0c0c0; width: 40px; height: 80px; margin-right: -60px; margin-top: 5px;">
            <img src="img/imagem.png" class="img-thumbnail" width="80" height="80">
        </div>
        <div class="col-1" style="width: 5px;"> </div>
        <div class="col-8 text-left" style="border: 2px solid #c0c0c0; width: 100%; height: 80px; margin-left: -60px;">
            Enter your Question
        </div>	
    </div>   
    <!-- end input enunciation question -->

    
    <!-- input answers Multiple Choice - mc -->
    <div class="row text-center d-flex justify-content-center align-items-center my-1 mx-5" name="div-answers-mc" id="div-answers-mc">
        <div class="col mb-2" id="div-answer1">
            <div class="row">
                <div class="col-2">
                    <i class="ion ion-ios-circle-outline mt-1 mr-2" style="font-size: 1.5em;"></i>
                </div>
                <div class="col-8" style="margin-left: -80px;">	
                    <textarea style="width:788px;" id="answer1" name="answer1" rows="1" onfocus="if (this.value=='  Option 1 ')this.value='  '" 
                            onblur="if(this.value=='  ') this.value='  Option 1 '">  Option 1 </textarea>	
                </div>
                <div class="col-1 bg-info" style="margin-left: 130px; height: 30px; padding-top: 2px;">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="right-wrong" id="right-wrong1" value="right-wrong1" checked>
                        <span id="span-rw1"> <img class="img-fluid" src="img/right.png" height="10px" style="margin-top: -4px;"> </span>
                    </div>
                </div>
            </div>
        </div>				
        <div class="col mb-2" id="div-answer2">
            <div class="row">
                <div class="col-2">
                    <i class="ion ion-ios-circle-outline mt-1 mr-2" style="font-size: 1.5em;"></i>
                </div>
                <div class="col-8" style="margin-left: -80px;">	
                    <textarea style="width:788px;" id="answer2" name="answer2" rows="1" onfocus="if (this.value=='  Option 2 ')this.value='  '" 
                            onblur="if(this.value=='  ') this.value='  Option 2 '">  Option 2 </textarea>	
                </div>
                <div class="col-1 bg-info" style="margin-left: 130px; height: 30px; padding-top: 2px;">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="right-wrong" id="right-wrong2" value="right-wrong2">
                        <span id="span-rw2"> <img class="img-fluid" src="img/wrong.png" height="30px" style="margin-top: -4px;"> </span>
                    </div>
                </div>						
            </div>
        </div>
        
        <div class="col-12 ml-5 pl-5 mb-2" id="div-btn-answer3">
            <div class="row">
                <div class="col-2">
                    <button type="button" class="btn btn-primary btn-sm" id="btn-answer3"> 
                        <i class="ion ion-plus"></i>
                        Answer					
                    </button>
                </div>
                <div class="col-10" style="margin-left: -50px;">	
                </div>
            </div>
        </div>
        <div class="col mb-2" style="display: none;" id="div-answer3">
            <div class="row">
                <div class="col-2">
                    <i class="ion ion-ios-circle-outline mt-1 mr-2" style="font-size: 1.5em;"></i>
                </div>
                <div class="col-8" style="margin-left: -80px;">	
                    <textarea style="width:788px;" id="answer3" name="answer3" rows="1" onfocus="if (this.value=='  Option 3 ')this.value='  '" 
                            onblur="if(this.value=='  ') this.value='  Option 3 '">  Option 3 </textarea>	
                </div>
                <div class="col-1 bg-info" style="margin-left: 130px; height: 30px; padding-top: 2px;">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="right-wrong" id="right-wrong3" value="right-wrong3">
                        <span id="span-rw3"> <img class="img-fluid" src="img/wrong.png" height="20px" style="margin-top: -4px;"> </span>
                    </div>
                </div>												
            </div>
        </div>				
        
        <div class="col-12 ml-5 pl-5 mb-2" id="div-btn-answer4" style="display: none;">
            <div class="row">
                <div class="col-2">
                    <button type="button" class="btn btn-primary btn-sm" id="btn-answer4"> 
                        <i class="ion ion-plus"></i>
                        Answer					
                    </button>
                </div>
                <div class="col-10" style="margin-left: -50px;">	
                </div>
            </div>
        </div>
        <div class="col mb-2" style="display: none;" id="div-answer4">
            <div class="row">
                <div class="col-2">
                    <i class="ion ion-ios-circle-outline mt-1 mr-2" style="font-size: 1.5em;"></i>
                </div>
                <div class="col-8" style="margin-left: -80px;">	
                    <textarea style="width:788px;" id="answer4" name="answer4" rows="1" onfocus="if (this.value=='  Option 4 ')this.value='  '" 
                            onblur="if(this.value=='  ') this.value='  Option 4 '">  Option 4 </textarea>	
                </div>
                <div class="col-1 bg-info" style="margin-left: 130px; height: 30px; padding-top: 2px;">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="right-wrong" id="right-wrong4" value="right-wrong4">
                        <span id="span-rw4"> <img class="img-fluid" src="img/wrong.png" height="20px" style="margin-top: -4px;"> </span>
                    </div>
                </div>												
            </div>
        </div>				
        
        <div class="col-12 ml-5 pl-5 mb-2" id="div-btn-answer5" style="display: none;">
            <div class="row">
                <div class="col-2">
                    <button type="button" class="btn btn-primary btn-sm" id="btn-answer5"> 
                        <i class="ion ion-plus"></i>
                        Answer					
                    </button>
                </div>
                <div class="col-10" style="margin-left: -50px;">	
                </div>
            </div>
        </div>
        <div class="col mb-2" style="display: none;" id="div-answer5">
            <div class="row">
                <div class="col-2">
                    <i class="ion ion-ios-circle-outline mt-1 mr-2" style="font-size: 1.5em;"></i>
                </div>
                <div class="col-8" style="margin-left: -80px;">	
                    <textarea style="width:788px;" id="answer5" name="answer5" rows="1" onfocus="if (this.value=='  Option 5 ')this.value='  '" 
                            onblur="if(this.value=='  ') this.value='  Option 5 '">  Option 5 </textarea>	
                </div>
                <div class="col-1 bg-info" style="margin-left: 130px; height: 30px; padding-top: 2px;">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="right-wrong" id="right-wrong5" value="right-wrong5">
                        <span id="span-rw5"> <img class="img-fluid" src="img/wrong.png" height="20px" style="margin-top: -4px;"> </span>
                    </div>
                </div>
            </div>
        </div>

    </div>	   
    <!-- end input answers Multiple Choice - mc -->

    
    <!-- input answers True and False - tf -->
    <div style="display: none;" class="row text-center d-flex justify-content-center align-items-center my-1 mx-5" name="div-answers-tf" id="div-answers-tf">
        <div class="col mb-2" id="div-tf1">
            <div class="row">
                <div class="col-2">
                    <div class="form-check">
                        <input class="form-text-input mr-1 text-center" type="text" name="issue11" id="issue1" maxlength="1" 
                                style="width: 30px; margin-left: -20px;" title="Type (T)rue or (F)alse" pattern="[TtFf]{1}" required>
                    </div>
                </div>
                <div class="col-10" style="margin-left: -80px;">	
                    <textarea style="width:888px;" id="issue-tf1" name="issue-tf1" rows="1" onfocus="if (this.value=='  Issue 1 ')this.value=''" 
                            onblur="if(this.value=='') this.value='  Issue 1 '">  Issue 1 </textarea>	
                </div>
            </div>
        </div>
        
        <div class="col mb-2" id="div-tf2">
            <div class="row">
                <div class="col-2">
                    <div class="form-check">								
                        <input class="form-text-input mr-1 text-center" type="text" name="issue21" id="issue2" maxlength="1" 
                                style="width: 30px; margin-left: -20px;" title="Type (T)rue or (F)alse" pattern="[TtFf]{1}" required>								
                    </div>
                </div>
                <div class="col-10" style="margin-left: -80px;">	
                    <textarea style="width:888px;" id="issue-tf2" name="issue-tf2" rows="1" onfocus="if (this.value=='  Issue 2 ')this.value=''" 
                            onblur="if(this.value=='') this.value='  Issue 2 '">  Issue 2 </textarea>	
                </div>
            </div>
        </div>
        
        <div class="col-12 ml-5 pl-5 mb-2" id="div-btn-issue3">
            <div class="row">
                <div class="col-2">
                    <button type="button" class="btn btn-primary btn-sm" id="btn-issue3"> 
                        <i class="ion ion-plus"></i>
                        Issue					
                    </button>
                </div>
                <div class="col-10" style="margin-left: -50px;">	
                </div>
            </div>
        </div>				
        <div class="col mb-2" id="div-tf3">
            <div class="row">
                <div class="col-2">
                    <div class="form-check">
                        <input class="form-text-input mr-1 text-center" type="text" name="issue31" id="issue3" maxlength="1" 
                                style="width: 30px; margin-left: -20px;" title="Type (T)rue or (F)alse" pattern="[TtFf]{1}" required>
                    </div>
                </div>
                <div class="col-10" style="margin-left: -80px;">	
                    <textarea style="width:888px;" id="issue-tf3" name="issue-tf3" rows="1" onfocus="if (this.value=='  Issue 3 ')this.value=''" 
                            onblur="if(this.value=='') this.value='  Issue 3 '">  Issue 3 </textarea>	
                </div>
            </div>
        </div>

        
        <div class="col-12 ml-5 pl-5 mb-2" id="div-btn-issue4">
            <div class="row">
                <div class="col-2">
                    <button type="button" class="btn btn-primary btn-sm" id="btn-issue4"> 
                        <i class="ion ion-plus"></i>
                        Issue					
                    </button>
                </div>
                <div class="col-10" style="margin-left: -50px;">	
                </div>
            </div>
        </div>				
        <div class="col mb-2" id="div-tf4">
            <div class="row">
                <div class="col-2">
                    <div class="form-check">
                        <input class="form-text-input mr-1 text-center" type="text" name="issue41" id="issue4" maxlength="1" 
                                style="width: 30px; margin-left: -20px;" title="Type (T)rue or (F)alse" pattern="[TtFf]{1}" required>
                    </div>
                </div>
                <div class="col-10" style="margin-left: -80px;">	
                    <textarea style="width:888px;" id="issue-tf4" name="issue-tf4" rows="1" onfocus="if (this.value=='  Issue 4 ')this.value=''" 
                            onblur="if(this.value=='') this.value='  Issue 4 '">  Issue 4 </textarea>	
                </div>
            </div>
        </div>

        
        <div class="col-12 ml-5 pl-5 mb-2" id="div-btn-issue5">
            <div class="row">
                <div class="col-2">
                    <button type="button" class="btn btn-primary btn-sm" id="btn-issue5"> 
                        <i class="ion ion-plus"></i>
                        Issue					
                    </button>
                </div>
                <div class="col-10" style="margin-left: -50px;">	
                </div>
            </div>
        </div>				
        <div class="col mb-2" style="display: block;" id="div-tf5">
            <div class="row">
                <div class="col-2">
                    <div class="form-check">
                        <input class="form-text-input mr-1 text-center" type="text" name="issue51" id="issue5"	 maxlength="1" 
                                style="width: 30px; margin-left: -20px;" title="Type (T)rue or (F)alse" pattern="[TtFf]{1}" required>
                    </div>
                </div>
                <div class="col-10" style="margin-left: -80px;">	
                    <textarea style="width:888px;" id="issue-tf5" name="issue-tf5" rows="1" onfocus="if (this.value=='  Issue 5 ')this.value=''" 
                            onblur="if(this.value=='') this.value='  Issue 5 '">  Issue 5 </textarea>	
                </div>
            </div>
        </div>
    
    </div>    
    <!-- end input answers True and False - tf -->


    <!-- input fill in the gaps - fg -->
    <div style="display: block;;" class="row text-center d-flex justify-content-center align-items-center my-1 mx-5" name="div-answers-fg" id="div-answers-fg">

        <div class="col-3"> </div>
        <div class="col-2" name="num_gaps" id="num_gaps">
            <b>number of gaps:</b>
        </div>
        
        <div class="col-4" name="opt_gaps" id="opt_gaps">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
              <label class="form-check-label" for="inlineRadio1">1</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
              <label class="form-check-label" for="inlineRadio2">2</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
              <label class="form-check-label" for="inlineRadio3">3</label>
            </div>				
        </div>
        <div class="col-3"></div>
    
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="col-10 mt-1 ml-5 pl-5" style="border: 2px ridge #007BFF; display: none;" id="hr-gap1" name="hr-gap1"> </div>  <!-- HR -->			
        
        <div class="col-12 mt-3">
            <div class="col mb-2" style="display: block;" id="div-part-fg1">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10" style="margin-left: -80px;">	
                        <textarea style="width:888px;" id="part-fg1" name="part-fg1" rows="1" onfocus="if (this.value=='  First part ')this.value=''" 
                                onblur="if(this.value=='') this.value='  First part '" required>  First part </textarea>	
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-1">
            <div class="col mb-2" style="display: block;" id="div-gap-fg1">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10" style="margin-left: -80px;">	
                        <textarea style="width:888px; background-color: #ffffb0;" id="gap-fg1" name="gap-fg1" rows="1" onfocus="if (this.value=='  First gap ')this.value=''" 
                                onblur="if(this.value=='') this.value='  First gap '" required>  First gap </textarea>	
                    </div>
                </div>
            </div>
        </div>
                        
        <div class="col-12 mt-2">
            <div class="col mb-2" style="display: none;" id="div-part-fg2">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10" style="margin-left: -80px;">	
                        <textarea style="width:888px;" id="part-fg2" name="part-fg2" rows="1" onfocus="if (this.value=='  Second part ')this.value=''" 
                                onblur="if(this.value=='') this.value='  Second part '">  Second part </textarea>	
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-1">
            <div class="col mb-2" style="display: none;" id="div-gap-fg2">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10" style="margin-left: -80px;">	
                        <textarea style="width:888px; background-color: #ffffb0;" id="gap-fg2" name="gap-fg2" rows="1" onfocus="if (this.value=='  Second gap ')this.value=''" 
                                onblur="if(this.value=='') this.value='  Second gap '">  Second gap </textarea>	
                    </div>
                </div>
            </div>
        </div>
                        
        <div class="col-12 mt-2">
            <div class="col mb-2" style="display: none;" id="div-part-fg3">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10" style="margin-left: -80px;">	
                        <textarea style="width:888px;" id="part-fg3" name="part-fg3" rows="1" onfocus="if (this.value=='  Third part ')this.value=''" 
                                onblur="if(this.value=='') this.value='  Third part '">  Third part </textarea>	
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-1">
            <div class="col mb-2" style="display: none;" id="div-gap-fg3">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10" style="margin-left: -80px;">	
                        <textarea style="width:888px; background-color: #ffffb0;" id="gap-fg2" name="gap-fg2" rows="1" onfocus="if (this.value=='  Third gap ')this.value=''" 
                                onblur="if(this.value=='') this.value='  Third gap '">  Third gap </textarea>	
                    </div>
                </div>
            </div>
        </div>
                        
        <div class="col-12 mt-1">
            <div class="col mb-2" style="display: block;" id="div-part-fg-last">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10" style="margin-left: -80px;">	
                        <textarea style="width:888px;" id="part-fg-last" name="part-fg-last" rows="1" onfocus="if (this.value=='  Last part ')this.value=''" 
                                onblur="if(this.value=='') this.value='  Last part '" required>  Last part </textarea>	
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end input fill in the gaps - fg -->			
    

    <!-- input subjective question - sq -->
    <div style="display: block;" class="row text-center d-flex justify-content-center align-items-center mb-1 ml-5" name="div-answers-sq" id="div-answers-sq">

        <div class="col ml-5" style=" margin-top: -110px;" id="div-text-sq" name="div-text-sq"> 
            <textarea style="width:888px; background-color: #ffffd9;" id="text-sq" name="text-sq" rows="8" onfocus="if (this.value=='  Text response ')this.value=''" 
                        onblur="if(this.value=='') this.value='  Text response '">  Text response </textarea>	
        </div>
        
    </div>
    <!-- end input subjective question - sq -->
    

    <!-- setup questions -->
    <div class="row text-center d-flex justify-content-center align-items-center my-4">

        <div class="col-2">
            <div class="input-group">
              <div class="input-group-prepend">
                    <div class="input-group-text">
                      <input type="checkbox" aria-label="Checkbox for following text input">
                    </div>
              </div>
              <input style="font-weight: 800; color: #fff;" type="text" class="form-control bg-primary" aria-label="Text input with checkbox" value="Required">
            </div>
        </div>

        <div class="col-1"> </div>
        <div class="col-2">
            <div class="input-group">
              <div class="input-group-prepend">
                    <div class="input-group-text">
                      <input type="checkbox" aria-label="Checkbox for following text input">
                    </div>
              </div>
              <input style="font-weight: 800; color: #fff;" type="text" class="form-control bg-primary" aria-label="Text input with checkbox" value="Image">
            </div>
        </div>
        
        <div class="col-1"> </div>
            <div class="col-2">				
                <div class="input-group">
                  <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="checkbox" aria-label="Radio button for following text input">
                        </div>
                      </div>
              <input style="font-weight: 800; color: #fff;" type="text" class="form-control bg-primary" aria-label="Text input with radio button" value="Numbering">
            </div>			
        </div>	

        <div class="col-1"> </div>				
            <div class="col-2">				
                <div class="input-group">
                  <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="checkbox" aria-label="Radio button for following text input">
                        </div>
                  </div>
                  <input style="font-weight: 800; color: #fff;" type="text" class="form-control bg-primary" aria-label="Text input with radio button" value="Points">
                </div>			
            </div>
        </div>
                    
    </div>
    <!-- end setup questions -->
            
    </div>		<!-- End .container - PRINCIPAL -->
    

                                <!-- FOOTER -->
    <div class="row">
            <div class="bg-primary footer text-center">
                <a class="navbar-brand" href="#">
                    <h3 class="h1-footer">
                        <?= ucfirst('footer'); ?> 
                    </h3>
                </a>
            </div>
		</div>

    </div>		<!-- End FOOTER -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

	<?php	
		include_once "scripts.php";
    ?>
    
  </div>              		<!-- End .container-fluid -->

</body>

</html>