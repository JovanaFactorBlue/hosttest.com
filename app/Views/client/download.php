<?php echo view('client/layouts/header'); ?>
<?php echo view('client/layouts/topNav'); ?>
<?php echo view('client/layouts/sideNav'); ?>
<?php $data = $this->data; ?>
<?php $boothId = basename($_SERVER['REQUEST_URI']); ?>
<div class="container">

</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">Booth Files</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action disabled"><b>View and download pdf files:</b></a>
                                <?php foreach($data as $key => $value){ 
                                        if($value['file_type'] == 'application/pdf'){?>
                                        <a href="/booths/myPdfPage/<?php echo $value['download_id']; ?>" class="list-group-item list-group-item-action">
                                            <?php echo $value['file_name']; ?>
                                        </a>
                                    <?php } ?>
                                <?php } ?> 
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-6">
                            <div class="row">
                                <h3>Click on the image to download:</h3>
                            </div>
                            <div class="row">
                                <?php foreach($data as $key => $value){ 
                                    if($value['is_image'] != 0){ ?>
                                        <div class="col-md-6">
                                            <a href="<?php echo ltrim($value['file_path'], '.'); ?>" download>
                                                <img src="<?php echo ltrim($value['file_path'], '.'); ?>" class="img-fluid" alt="Responsive image">
                                            </a>                     
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Upload a file for visitors to download</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="/index.php/booths/uploadDownloadables" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
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
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-comment-dots"></i></span>
                                    </div>
                                    <input type="hidden" name="booth_id" value="<?php echo $boothId; ?>">
                                    <input type="text" name="title" class="form-control" placeholder="Enter a title for your document">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file" id="fileInput">
                                    <label class="custom-file-label" for="fileInput">Choose a file...</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary">Upload Document</button>
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