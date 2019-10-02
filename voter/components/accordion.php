<div class="row">
    <div class="col-md-12">
        <?php
            $isPoll = false;
            $query = $select->getPoll();
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $poll = $row['poll_no'];
                $isPoll = true;
                if($row['poll_status'] == 5){
                    echo '
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">POLL # '.$row['poll_no'].' - '; 
                            if($row['poll_status'] == 4){ 
                                echo ' <div class="mb-2 mr-2 badge badge-pill badge-danger">'.$row['status_name'].'</div>'; 
                            }
                            else{
                                echo ' <div class="mb-2 mr-2 badge badge-pill badge-primary">'.$row['status_name'].'</div>';
                            }
                            echo '</h5>
                            <small class="form-text text-muted">Created at: '.$row['created_at'].'</small>
                            <div class="collapse mt-3" id="card-collapse'.$row['poll_id'].'">
            
                                <div class="col-md-12">
                                    <div id="accordion-'.$poll.'" class="accordion-wrapper">
                                    ';
                                        
                                    $collapse_no = 0;
                                    $query2 = $select->getPositions();
                                    while($row2 = $query2->fetch(PDO::FETCH_ASSOC)){
                                        echo'
                                            <div class="card">
                                                <div id="headingOne" class="card-header">
                                                    <button type="button" data-toggle="collapse" data-target="#collapse'.$collapse_no.'-'.$poll.'" aria-expanded="true" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block">
                                                        <h6 class="m-0 p-0">'.$row2['pos_name'].'</h6>
                                                    </button>
                                                </div>
                                                <div data-parent="#accordion-'.$poll.'" id="collapse'.$collapse_no.'-'.$poll.'" aria-labelledby="headingOne" class="collapse">
                                                    <div class="card-body">
                                                        <table class="table table-hover table-bordered" id="candidate-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Full Name</th>
                                                                    <th>Motto</th>
                                                                    <th>Votes</th>
                                                                    <th colspan="2">Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody> 
                                                            '; 
                                                                if($row['poll_status'] == 5){
                                                                    if($row2['pos_id'] == 1){
                                                                        $ctr = 0;
                                                                        $radio_ctr = 0;
                                                                        $select->poll_id = $row['poll_no'];
                                                                        $president = $select->getPresident(5);
                                                                        while($pres = $president->fetch(PDO::FETCH_ASSOC)){
                                                                            echo'
                                                                            <tr>
                                                                                <td>'.$pres['user_fullname'].'</td>
                                                                                <td>'.$pres['user_motto'].'</td>
                                                                                <td>'.$pres['total_votes'].'</td>
                                                                                <td style="text-align: center">
                                                                                    <button class="mb-2 mr-2 btn btn-primary" data-toggle="tooltip" title="See Information" data-placement="bottom" ><i class="fa fa-id-card"></i> See Information</button>
                                                                                </td>
                                                                                <td style="text-align: center">
                                                                                    <div class="custom-radio custom-control">
                                                                                        <input type="radio" id="radio'.$ctr.'-'.$poll.'" name="president-radio-'.$collapse_no.'-'.$poll.'" class="custom-control-input president" value="'.$pres['voters_id'].'">
                                                                                        <label class="custom-control-label" for="radio'.$ctr.'-'.$poll.'"> Vote</label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            ';
                                                                            $ctr++;
                                                                        }
                                                                    }
                                                                    else if($row2['pos_id'] == 2){
                                                                        $vice_pres = $select->getVicePresident(5);
                                                                        while($vice = $vice_pres->fetch(PDO::FETCH_ASSOC)){
                                                                            echo'
                                                                            <tr>
                                                                                <td>'.$vice['user_fullname'].'</td>
                                                                                <td>'.$vice['user_motto'].'</td>
                                                                                <td>'.$vice['total_votes'].'</td>
                                                                                <td style="text-align: center">
                                                                                <button class="mb-2 mr-2 btn btn-primary" data-toggle="tooltip" title="See Information" data-placement="bottom" ><i class="fa fa-id-card"></i> See Information</button>
                                                                                </td>
                                                                                <td style="text-align: center">
                                                                                    <div class="custom-radio custom-control">
                                                                                    <input type="radio" id="radio'.$ctr.'-'.$poll.'" name="vice_pres-radio-'.$collapse_no.'-'.$poll.'" class="custom-control-input vice_pres" value="'.$vice['voters_id'].'">
                                                                                    <label class="custom-control-label" for="radio'.$ctr.'-'.$poll.'"> Vote</label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            ';
                                                                            $ctr++;
                                                                        }
                                                                    }
                                                                    else if($row2['pos_id'] == 3){
                                                                        $secretary = $select->getSecretary(5);
                                                                        while($sec = $secretary->fetch(PDO::FETCH_ASSOC)){
                                                                            echo'
                                                                            <tr>
                                                                                <td>'.$sec['user_fullname'].'</td>
                                                                                <td>'.$sec['user_motto'].'</td>
                                                                                <td>'.$sec['total_votes'].'</td>
                                                                                <td style="text-align: center">
                                                                                <button class="mb-2 mr-2 btn btn-primary" data-toggle="tooltip" title="See Information" data-placement="bottom" ><i class="fa fa-id-card"></i> See Information</button>
                                                                                </td>
                                                                                <td style="text-align: center">
                                                                                    <div class="custom-radio custom-control">
                                                                                    <input type="radio" id="radio'.$ctr.'-'.$poll.'" name="secretary-radio-'.$collapse_no.'-'.$poll.'" class="custom-control-input secretary" value="'.$sec['voters_id'].'">
                                                                                    <label class="custom-control-label" for="radio'.$ctr.'-'.$poll.'"> Vote</label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            ';
                                                                            $ctr++;
                                                                        }
                                                                    }
                                                                    else if($row2['pos_id'] == 4){
                                                                        $treasurer = $select->getTreasurer(5);
                                                                        while($tres = $treasurer->fetch(PDO::FETCH_ASSOC)){
                                                                            echo'
                                                                            <tr>
                                                                                <td>'.$tres['user_fullname'].'</td>
                                                                                <td>'.$tres['user_motto'].'</td>
                                                                                <td>'.$tres['total_votes'].'</td>
                                                                                <td style="text-align: center">
                                                                                <button class="mb-2 mr-2 btn btn-primary" data-toggle="tooltip" title="See Information" data-placement="bottom" ><i class="fa fa-id-card"></i> See Information</button>
                                                                                </td>
                                                                                <td style="text-align: center">
                                                                                    <div class="custom-radio custom-control">
                                                                                    <input type="radio" id="radio'.$ctr.'-'.$poll.'" name="treasurer-radio-'.$collapse_no.'-'.$poll.'" class="custom-control-input treasurer" value="'.$tres['voters_id'].'">
                                                                                    <label class="custom-control-label" for="radio'.$ctr.'-'.$poll.'"> Vote</label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            ';
                                                                            $ctr++;
                                                                        }
                                                                    }
                                                                    else if($row2['pos_id'] == 5){
                                                                        $PIO = $select->getPIO(5);
                                                                        while($pio = $PIO->fetch(PDO::FETCH_ASSOC)){
                                                                            echo'
                                                                            <tr>
                                                                                <td>'.$pio['user_fullname'].'</td>
                                                                                <td>'.$pio['user_motto'].'</td>
                                                                                <td>'.$pio['total_votes'].'</td>
                                                                                <td style="text-align: center">
                                                                                <button class="mb-2 mr-2 btn btn-primary" data-toggle="tooltip" title="See Information" data-placement="bottom" ><i class="fa fa-id-card"></i> See Information</button>
                                                                                </td>
                                                                                <td style="text-align: center">
                                                                                    <div class="custom-radio custom-control">
                                                                                    <input type="radio" id="radio'.$ctr.'-'.$poll.'" name="PIO-radio-'.$collapse_no.'-'.$poll.'" class="custom-control-input PIO" value="'.$pio['voters_id'].'">
                                                                                    <label class="custom-control-label" for="radio'.$ctr.'-'.$poll.'"> Vote</label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            ';
                                                                            $ctr++;
                                                                        }
                                                                    }
                                                                    else if($row2['pos_id'] == 6){
                                                                        $auditor = $select->getAuditor(5);
                                                                        while($audit = $auditor->fetch(PDO::FETCH_ASSOC)){
                                                                            echo'
                                                                            <tr>
                                                                                <td>'.$audit['user_fullname'].'</td>
                                                                                <td>'.$audit['user_motto'].'</td>
                                                                                <td>'.$audit['total_votes'].'</td>
                                                                                <td style="text-align: center">
                                                                                <button class="mb-2 mr-2 btn btn-primary" data-toggle="tooltip" title="See Information" data-placement="bottom" ><i class="fa fa-id-card"></i> See Information</button>
                                                                                </td>
                                                                                <td style="text-align: center">
                                                                                    <div class="custom-radio custom-control">
                                                                                    <input type="radio" id="radio'.$ctr.'-'.$poll.'" name="auditor-radio-'.$collapse_no.'-'.$poll.'" class="custom-control-input auditor" value="'.$audit['voters_id'].'">
                                                                                    <label class="custom-control-label" for="radio'.$ctr.'-'.$poll.'"> Vote</label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            ';
                                                                            $ctr++;
                                                                        }
                                                                    }
                                                                    else if($row2['pos_id'] == 7){
                                                                        $sergeant_at_arms = $select->getSergeantAtArms(5);
                                                                        while($arms = $sergeant_at_arms->fetch(PDO::FETCH_ASSOC)){
                                                                            echo'
                                                                            <tr>
                                                                                <td>'.$arms['user_fullname'].'</td>
                                                                                <td>'.$arms['user_motto'].'</td>
                                                                                <td>'.$arms['total_votes'].'</td>
                                                                                <td style="text-align: center">
                                                                                <button class="mb-2 mr-2 btn btn-primary" data-toggle="tooltip" title="See Information" data-placement="bottom" ><i class="fa fa-id-card"></i> See Information</button>
                                                                                </td>
                                                                                <td style="text-align: center">
                                                                                    <div class="custom-radio custom-control">
                                                                                        <input type="radio" id="radio'.$ctr.'-'.$poll.'" name="sergeant_at_arms-radio-'.$collapse_no.'-'.$poll.'" class="custom-control-input sergeant_at_arms" value="'.$arms['voters_id'].'">
                                                                                        <label class="custom-control-label" for="radio'.$ctr.'-'.$poll.'"> Vote</label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            ';
                                                                            $ctr++;
                                                                        }
                                                                    }

                                                                    else if($row2['pos_id'] == 8){
                                                                        $representatives = $select->getRepresentatives(5);
                                                                        while($rep = $representatives->fetch(PDO::FETCH_ASSOC)){
                                                                            echo'
                                                                            <tr>
                                                                                <td>'.$rep['user_fullname'].'</td>
                                                                                <td>'.$rep['user_motto'].'</td>
                                                                                <td>'.$rep['total_votes'].'</td>
                                                                                <td style="text-align: center">
                                                                                <button class="mb-2 mr-2 btn btn-primary" data-toggle="tooltip" title="See Information" data-placement="bottom" ><i class="fa fa-id-card"></i> See Information</button>
                                                                                </td>
                                                                                <td style="text-align: center">
                                                                                    <div class="custom-radio custom-control">
                                                                                        <input type="radio" id="radio'.$ctr.'-'.$poll.'" name="representatives-radio-'.$collapse_no.'-'.$poll.'" class="custom-control-input representatives" value="'.$rep['voters_id'].'">
                                                                                        <label class="custom-control-label" for="radio'.$ctr.'-'.$poll.'"> Vote</label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            ';
                                                                            $ctr++;
                                                                        }
                                                                    }
                                                                }
                                                            echo '
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                        $collapse_no++;
                                    }

                                echo'
                                    <button type="button" class="btn ml-2  mb-2 mt-4 btn-danger send-votes float-right col-md-4" value="'.$row['poll_no'].'" id="vote-btn'.$row['poll_no'].'">Send Votes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" data-toggle="collapse" href="#card-collapse'.$row['poll_id'].'" class="btn mr-2 btn-primary">View Candidates</button>
                        </div>
                    </div>
                    ';
                }
                else{
                    if($row['poll_status'] == 4){
                        echo '
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">POLL # '.$row['poll_no'].' - '; 
                                if($row['poll_status'] == 4){ 
                                    echo ' <div class="mb-2 mr-2 badge badge-pill badge-danger">'.$row['status_name'].'</div>'; 
                                }
                                else{
                                    echo ' <div class="mb-2 mr-2 badge badge-pill badge-primary">'.$row['status_name'].'</div>';
                                }
                                echo '</h5>
                                <small class="form-text text-muted">Created at: '.$row['created_at'].'</small>
                            </div>
                            <div class="card-footer">
                                <button type="button" data-toggle="modal" href="#statistics" class="btn mr-2 btn-warning statistics" value="'.$poll.'">View Statistics</button>
                            </div>
                        </div>
                        ';
                    }
                }
            }

            if(!$isPoll){
                echo '
                    <div class="main-card mb-3 card">
                        <div class="card-body" align="center">
                            <h5 class="card-title mt-2">NO POLL AVAILABLE THIS TIME</h5>
                        </div>
                    </div>
                ';
            }
        ?>
    </div>
</div>