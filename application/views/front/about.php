<div id="allSet">
    <section class=" __about__bg__co">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 p-0  text-center">
                    <div class="  ___center__flex pt-5 ">
                        <h1 class=""><?=$this->lang->line('about_menu')?></h1>

                        <h4 class=" Our_talk"><?=$this->lang->line('we_talk_about_cont')?></h4>
                        <div class="__para__about mt-2">
                            <h5 class=""><?=$this->lang->line('help_you_cont_about_us')?></h5>
                        </div>

                        <div class="__slot_inner mt-5">
                            <a href="<?=base_url()?>legal-advice" class="btn "><?=$this->lang->line('book_slot_menu')?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="_wp_law_pd" style="padding:0px;">
        <div class="container">
            <div class="row pt-3">
                <div class="col-md-8 law_client">
                    <div class="d-flex flex-row bd-highlight ">
                        <div class="p-2 bd-highlight insaf_Base132"><?=$this->lang->line('insaaf99_cont')?></div>
                        <div class="p-2 bd-highlight ___online_Legal"><a href="<?=base_url()?>legal-advice"
                                style="text-decoration: none; color:#000"><?=$this->lang->line('need_online_about')?></a>
                        </div>
                    </div>
                    <p class="about-conta mt-3 mb-0"><span class="insaafhjh"><?=$this->lang->line('insaaf_about')?></p>
                    <p class="about-conta mt-3 mb-0"><?=$this->lang->line('start_about')?></p>
                    <p class="about-conta mt-3 mb-0"><?=$this->lang->line('endeavours_about')?></p>
                    <p class="about-conta mt-3 mb-0"><?=$this->lang->line('has_an_about')?></p>
                    <p class="about-conta mt-3 mb-0"><?=$this->lang->line('we_at_about')?></p>
                </div>
                <div class="col-md-4">
                    <div class="img">
                        <img src="<?php echo base_url()?>assets/images/law__about.webp" alt=" legal attorney online"
                            class="img-fluid" alt="about">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="colo-12 law_client">
                    <p class="about-conta pl-3 pt-2"><?=$this->lang->line('here_about')?>
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    $("#Query").change(function() {
        var val = $(this).val();
        if (val == "Personal / Family Lawyer1") {
            $("#sub_query").html(
                "<option value='test'>item1: test 1</option><option value='test2'>item1: test 2</option>"
            );
        } else if (val == "Personal / Family Lawyer2") {
            $("#sub_query").html(
                "<option value='test'>item2: test 1</option><option value='test2'>item2: test 2</option>"
            );
        } else if (val == "Personal / Family Lawyer3") {
            $("#sub_query").html(
                "<option value='test'>item3: test 1</option><option value='test2'>item3: test 2</option>"
            );
        } else if (val == "Personal / Family Lawyer4") {
            $("#sub_query").html(
                "<option value='test'>item4: test 1</option><option value='test2'>item4: test 2</option><option value='test2'>item4: test 2</option>"
            );
        }
    });
});
</script>