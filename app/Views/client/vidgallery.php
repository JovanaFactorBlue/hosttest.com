<?php
$booth = $this->data;
$videos = $booth['vids'];
$vidN = $booth['type']['videosNum'];
use App\Models\BoothModel;

echo view('client/layouts/header');
echo view('client/layouts/topNav');
echo view('client/layouts/sideNav');

if(isset($message)){
    var_dump($message);
} ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Booth Video Gallery</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <?php if(!empty($videos)){ ?>
                      <div class="row">
                      <?php foreach($videos as $key => $value){ 
                                if(!empty($value['embed_code'])){
                                  $src = $value['embed_code'];
                                }elseif(empty($value['embed_code'])){
                                  $src = $value['url'];
                                }
                        ?>
                              <div class="card card-outline card-warning col-md-6">
                                
                                <?php if(!empty($value['embed_code'])){ ?>
                                  <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="<?php echo $src; ?>"></iframe>
                                    </div>
                                <?php }elseif(empty($value['embed_code'])){ ?>
                                  
                                  <iframe src="<?php echo $src; ?>" frameborder="0" autoplay></iframe>
                                  
                                <?php } ?>
                                
                                <a href="../index.php/Booths/deleteVideo/<?php echo $value['video_id'];?>" class="btn btn-outline-danger">Remove video</a>
                              </div>
                        <?php } ?>
                      
                        </div>
                        
                    <?php }else{ ?>
                        <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Add videos to attract more visitors to your booth.</span>
                            <div class="progress">
                            <div class="progress-bar bg-info" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">
                            <cite>Up to 70% more visits</cite>
                            </span>
                        </div>
                        </div>
                        <h3></h3>
                    <?php } ?> 
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Choose a social media link to embed or add a direct link to the video</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="/index.php/booths/uploadVideo" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1" name="type" value="social" checked>
                                            <label for="customRadio1" class="custom-control-label">YouTube, Vimeo or Facebook</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio2" name="type" value="direct">
                                            <label for="customRadio2" class="custom-control-label">Direct link to mp4 file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                          <label>Select Language</label>
                          <select class="custom-select" name="language">
                              <option value="" disabled selected>Select a language</option>
                              <option value="Afrikaans">Afrikaans</option>
                              <option value="Albanian">Albanian</option>
                              <option value="Arabic">Arabic</option>
                              <option value="Armenian">Armenian</option>
                              <option value="Basque">Basque</option>
                              <option value="Bengali">Bengali</option>
                              <option value="Bulgarian">Bulgarian</option>
                              <option value="Catalan">Catalan</option>
                              <option value="Cambodian">Cambodian</option>
                              <option value="Chinese (Mandarin)">Chinese (Mandarin)</option>
                              <option value="Croatian">Croatian</option>
                              <option value="Czech">Czech</option>
                              <option value="Danish">Danish</option>
                              <option value="Dutch">Dutch</option>
                              <option value="English">English</option>
                              <option value="Estonian">Estonian</option>
                              <option value="Fiji">Fiji</option>
                              <option value="Finnish">Finnish</option>
                              <option value="French">French</option>
                              <option value="Georgian">Georgian</option>
                              <option value="German">German</option>
                              <option value="Greek">Greek</option>
                              <option value="Gujarati">Gujarati</option>
                              <option value="Hebrew">Hebrew</option>
                              <option value="Hindi">Hindi</option>
                              <option value="Hungarian">Hungarian</option>
                              <option value="Icelandic">Icelandic</option>
                              <option value="Indonesian">Indonesian</option>
                              <option value="Irish">Irish</option>
                              <option value="Italian">Italian</option>
                              <option value="Japanese">Japanese</option>
                              <option value="Javanese">Javanese</option>
                              <option value="Korean">Korean</option>
                              <option value="Latin">Latin</option>
                              <option value="Latvian">Latvian</option>
                              <option value="Lithuanian">Lithuanian</option>
                              <option value="Macedonian">Macedonian</option>
                              <option value="Malay">Malay</option>
                              <option value="Malayalam">Malayalam</option>
                              <option value="Maltese">Maltese</option>
                              <option value="Maori">Maori</option>
                              <option value="Marathi">Marathi</option>
                              <option value="Mongolian">Mongolian</option>
                              <option value="Nepali">Nepali</option>
                              <option value="Norwegian">Norwegian</option>
                              <option value="Persian">Persian</option>
                              <option value="Polish">Polish</option>
                              <option value="Portuguese">Portuguese</option>
                              <option value="Punjabi">Punjabi</option>
                              <option value="Quechua">Quechua</option>
                              <option value="Romanian">Romanian</option>
                              <option value="Russian">Russian</option>
                              <option value="Samoan">Samoan</option>
                              <option value="Serbian">Serbian</option>
                              <option value="Slovak">Slovak</option>
                              <option value="Slovenian">Slovenian</option>
                              <option value="Spanish">Spanish</option>
                              <option value="Swahili">Swahili</option>
                              <option value="Swedish ">Swedish </option>
                              <option value="Tamil">Tamil</option>
                              <option value="Tatar">Tatar</option>
                              <option value="Telugu">Telugu</option>
                              <option value="Thai">Thai</option>
                              <option value="Tibetan">Tibetan</option>
                              <option value="Tonga">Tonga</option>
                              <option value="Turkish">Turkish</option>
                              <option value="Ukrainian">Ukrainian</option>
                              <option value="Urdu">Urdu</option>
                              <option value="Uzbek">Uzbek</option>
                              <option value="Vietnamese">Vietnamese</option>
                              <option value="Welsh">Welsh</option>
                              <option value="Xhosa">Xhosa</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                      <!-- Select multiple-->
                        <div class="form-group">
                          <label>Select Video Position</label>
                          <select multiple class="custom-select" name="position">
                          <?php if(!empty($booth['positions'])){
                                  foreach($booth['positions'] as $key => $value){ ?> 
                                    <option value="<?php echo $value; ?>">Position <?php echo $value; ?></option>
                              <?php } 
                                }else{
                                  for($i = 1;$i <= $vidN;$i++){ ?>
                                    <option value="<?php echo $i; ?>" <?php if($i==1){echo 'selected';} ?>>Position <?php echo $i; ?></option>
                              <?php }
                                }?>

                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10">
                        <div class="form-group">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-comment-dots"></i></span>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $booth['id']; ?>">
                            <input type="text" name="title" class="form-control" placeholder="Enter a title for your video">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10">
                        <div class="form-group">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-link"></i></span>
                            </div>
                            <input type="text" name="link" class="form-control" placeholder="Paste link here">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group">
                        <button type="submit" class="btn btn-secondary">Upload</button>
                      </div>
                    </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-6"></div>
    </div>
</div>
<?php echo view('client/layouts/footer'); ?>