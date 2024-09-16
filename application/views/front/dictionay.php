<?php if(isset($alphabet) && !empty($alphabet)){?>

<section class="for_sec_sts_fixed">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="sc-fYiAbW IVTMa sticky">
                    <ul>
                        <li><a href="##">#</a></li>
                        <?php foreach($alphabet as $key => $value){
                       
                            ?>
                        <li><a href="#<?php echo $value?>" action="<?=base_url('index/getdictionary')?>"
                                class="clickthis"><?php echo $value?></a></li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="fro_one_serucf">
                    <div class="search-container">
                        <form id="search" class="for_chng_buton_dixc" method="post">
                            <input type="text" placeholder="Search.." name="search" id="searchData" required>
                            <button type="submit"><img src="<?php echo base_url()?>assets/images/svg/search.svg" class="img-fluid" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="next_cls_star_mar searchWord">
    <div class="container-fluid">
        <div class="row" id="<?php echo $dictionary_data->alphabet?>">
            <div class="col-md-2">
                <div class="single_text_act">
                    <p id="<?php echo $dictionary_data->alphabet?>" class="left___fix__box">
                        <?php echo $dictionary_data->alphabet?>
                    </p>
                </div>
            </div>
            <div class="col-md-10">
                <div class="new_clsd_dic" id="<?php echo $dictionary_data->alphabet?>">
                    <div class="row">
                        <div class="col-md-10">
                            <?php echo $dictionary_data->descreption?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="next_cls_star_mar searchWord">
    <div class="container-fluid" id="showData">

    </div>
</section>




<?php }else{?>
<h2 class="text-center text-warning p-3">No Data Found</h2>
<?php }?>



<script>
$(document).ready(function() {

    $("#search").submit(function(e) {
        e.preventDefault();
        var searchValue = $('#searchData').val();
        var divValue = $('.searchWord').text();
        $(".searchWord").each(function() {
            if ($(this).html().indexOf(searchValue) > -1) {
                divValue.replace(searchValue, "Suresh");
            }
        });
    })



    var url = $('.clickthis').attr('action');
    var arr = <?php echo $alphabetForJson;?>;

    for (i = 1; i < arr.length; i++) {
        var alphabet = arr[i];
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                'alphabet': alphabet
            },
            success: function(responce) {
                var val = JSON.parse(responce);
                var html = '';
                html += '<div class="row" id="' + val[0][0]['alphabet'] + '">';
                html += '  <div class="col-md-2">';
                html += '    <div class="single_text_act">';
                html += '       <p id="' + val[0][0]['alphabet'] +
                    '" class="left___fix__box">' + val[0][0]['alphabet'] + '</p>';
                html += '     </div>';
                html += '  </div>';
                html += '  <div class="col-md-10">';
                html += '       <div class="new_clsd_dic" id="' + val[0][0]['alphabet'] +
                    '">';
                html += '          <div class="row">';
                html += '             <div class="col-md-10">' + val[0][0]['descreption'] +
                    '</div>';
                html += '           </div>';
                html += '       </div>';
                html += '  </div>';
                html += '</div>';
                $('#showData').append(html);

            }

        });
    }


});
</script>

</div>