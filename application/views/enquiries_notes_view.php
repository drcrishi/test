<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
//                                                                        echo "<pre>";
//                                                                        print_r($notes);
//                                                                        die;

foreach ($notes as $nt) {

    $notesid = explode("##", $nt['nid']);
    krsort($notesid);

    $notestitle = explode("##", $nt['nt']);
    $notesd = explode("##", $nt['nd']);
    $notesda = explode("##", $nt['ndate']);
    $nattach = explode("##", $nt['nattach']);
    $uName = explode("##", $nt['uName']);

    $adminuser = $nt['admin_firstname'];
    $notesdate = $nt['notes_date'];
    $notesattach = $nt['notes_attachedfile'];
    foreach ($notesid as $notesidkey => $notesidValue) {
        $notesID = $notesidValue;
        if (isset($notestitle[$notesidkey])) {
            $notesTitle = $notestitle[$notesidkey];
        }
        if (isset($notesd[$notesidkey])) {
            $notesDesc = $notesd[$notesidkey];
        }
        if (isset($notesda[$notesidkey])) {
            $notesDate = $notesda[$notesidkey];
        }
        if (isset($nattach[$notesidkey])) {
            $notesAttach = $nattach[$notesidkey];
        }
        if (isset($uName[$notesidkey])) {
            $notesuName = $uName[$notesidkey];
        }
        ?> 
        <div class="activity-item">
            <span class="close-notes" data-id="<?php echo $notesID; ?>">&#10006;</span>
        <!--                <h6><?php //echo $notesTitle;  ?></h6>-->

            <p><?php echo $notesDesc; ?></p>
            <?php
            if ($notesAttach == "") {
                
            } else {
                ?> 

                <p><a href="<?php echo base_url() . 'enquiries/downloadNotes/' . $notesID; ?> "> Attachment </a></p>
            <?php } ?>

            <p>
                <a href="#"><?php echo $notesuName; ?></a>
                <?php
                $date = $notesDate;
                echo date('d-m-Y h:i:s A', strtotime($date));
                //  echo date("d-m-Y H:m:s A", strtotime($notesda[$zz++])); 
                ?>
            </p></div>
        <?php
    }
}
?>

