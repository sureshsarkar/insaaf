<section class="bg-imgag1 pt-1 bg-img  pb-5">
    <div class="for-borderpp">
        <div class="container hhff">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="base_  pt-5 bold2 text-center ">
                        <span style="font-weight: 500;font-family: playfair display;">
                            <?=$this->lang->line('all_letast_news_cont');?> </span>
                    </h4>
                    <div class="lase_ind_endf">
                        <div class="search-container ">
                            <form id="searchData" class="for_chng_buton_dixc">
                                <input type="text" class="searchInput" placeholder="Search.." name="search">
                                <button type="submit"><img src="<?php echo base_url()?>assets/images/svg/search.svg"
                                        class="img-fluid" alt=""></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="searchDiv"></div>
                <div class="row pt-5">
                    <?php if(!empty($latest_news)){ foreach($latest_news as $news){?>
                    <div class="col-md-4 mobileSpace lastDiv">
                        <div class="card">
                            <img class="card-img-top ___news_Card img-fluid"
                                src="<?=base_url()?>uploads/news/<?=$news->image?>" alt="<?=$news->img_alt?>">
                            <div class="p-2">
                                <div class="my_doc11">
                                    <div class="docu1 ">
                                        <div class="law_client">
                                            <div class="hiw-content hiw-static ">
                                                <div class="tile-item">
                                                    <div class="icon-circle-box">
                                                        <div class="icon-circle">
                                                            <div class="bg-hiw_choose_your_required_icon"></div>
                                                        </div>
                                                    </div>
                                                    <div class="description _desk_head app">
                                                        <p class="pt-2  mb-0 DT">
                                                            <i
                                                                class="bi bi-calendar-check pr-2"></i><?=$news->adding_date?>
                                                        </p>
                                                        <h5 class="mb-0 text-justify">
                                                            <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $news->news_cat_hi;
                                                                }else{
                                                                    echo $news->news_cat;
                                                                }?>
                                                        </h5>
                                                        <div class="exp">
                                                            <p class="pt-2  mb-0 ">
                                                                <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $news->expert_hi;
                                                                }else{
                                                                    echo $news->expert;
                                                                }?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="lecs_lind_cdnfty">
                                            <a href="<?=base_url()?>latest-news/<?=$news->slug_url?>"
                                                class="btn "><?=$this->lang->line('view_more_cont');?><img
                                                    src="<?php echo base_url()?>assets/images/svg/arrow-right-short.svg"
                                                    class="img-fluid" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }}else{?>
                    <div class="container">
                        <div class="row py-5">
                            <div class="col-md-12 text-center">
                                <img src="<?= base_url('assets/images/search-not-found.webp')?>" class="img-fluid">
                                <br /><br />
                                <p class="">Search Not found.</p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {

    $("#searchData").submit(function(e) {
        e.preventDefault(e);
        var search = $(".searchInput").val();

        if (search == "") {
            alert("Please enter that you want to search !");
            return false;
        }

        let url = "<?php echo base_url('index/searchNews')?>";

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                search: search
            },
            success: function(res) {

                console.log(res);

                if (res == 2) {
                    var html = '<h1 class="text-center">No Data Found</h1>';
                    $(".lastDiv").hide();
                    $(".searchDiv").html(html);
                } else {
                    var Array = JSON.parse(res);
                    var responce = Array.result;
                    var html = '';
                    html += '<div class="row">';
                    for (let i = 0; i < responce.length; i++) {

                        html += '<div class="col-md-4 mobileSpace">';
                        html += '<div class="card">';
                        html +=
                            '<img class="card-img-top ___news_Card img-fluid" src="<?=base_url()?>uploads/news/' +
                            responce[i].image + '" alt="online advocate help">';
                        html += '<div class="p-2">';
                        html += '    <div class="my_doc11">';
                        html += '        <div class="docu1 ">';
                        html += '            <div class="law_client">';
                        html += '                <div class="hiw-content hiw-static ">';
                        html += '                    <div class="tile-item">';
                        html += '                        <div class="icon-circle-box">';
                        html += '                            <div class="icon-circle">';
                        html +=
                            '                                <div class="bg-hiw_choose_your_required_icon"></div>';
                        html += '                            </div>';
                        html += '                        </div>';
                        html +=
                            '                        <div class="description _desk_head app">';
                        html += '                            <p class="pt-2  mb-0 DT">';
                        html +=
                            '                                <i class="bi bi-calendar-check pr-2"></i>' +
                            responce[i].adding_date;
                        html += '                            </p>';
                        html +=
                            '                            <h5 class="mb-0 text-justify">';
                        html +=
                            '<?php if(isset($_COOKIE["lang"]) && !empty($_COOKIE["lang"]=="hindi")){ ?>' +
                            responce[i].news_cat_hi;
                        html += '<?php }else{ ?>' + responce[i].news_cat;
                        html += '<?php } ?>';
                        html += '                            </h5>';
                        html += '                            <div class="exp">';
                        html += '                                <p class="pt-2  mb-0 ">';
                        html +=
                            ' <?php if(isset($_COOKIE["lang"]) && !empty($_COOKIE["lang"]=="hindi")){?>' +
                            responce[i].expert_hi;
                        html += ' <?php }else{ ?>' + responce[i].expert;
                        html += ' <?php } ?>';
                        html += '                                </p>';
                        html += '                            </div>';
                        html += '                        </div>';
                        html += '                    </div>';
                        html += '                </div>';
                        html += '            </div>';
                        html += '        </div>';
                        html += '    </div>';
                        html += '</div>';
                        html += '<div class="container">';
                        html += '    <div class="row">';
                        html += '        <div class="col-md-12 ">';
                        html += '            <div class="lecs_lind_cdnfty">';
                        html += '                <a href="<?=base_url()?>latest-news/' +
                            responce[i]
                            .slug_url +
                            '" class="btn "><?=$this->lang->line('view_more_cont');?><i class="bi bi-caret-right-fill"></i>'
                        html += '                </a>';
                        html += '            </div>';
                        html += '        </div>';
                        html += '    </div>';
                        html += '</div>';
                        html += ' </div>';
                        html += ' </div>';
                    }
                    html += ' </div>';

                    $(".lastDiv").hide();
                    $(".searchDiv").html(html);
                }
            }
        });
    })
});
</script>

<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>