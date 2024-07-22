<!-- SAMPLE -->
        <section class="bg-primary" id="about">
            <div class="container">
                <div class="row">
                    <div class="about-right">
                        <?php
                            if(!isset($_SESSION['login'])){
                        ?>
                        <div class="module form-module">
                            <img src="img/karate.png" alt="logo" style="width: 30%;margin-left: 35%;margin-top: 5%; border-radius: 15%; opacity: 90%;"/>

                          

                            <div class="form">
                                <h2>Login </h2>
                                    <form id="login" action="" method="POST" name="login">
                                        <input id="email" type="text" name="email" placeholder="Staff Email"/>
                                        <input id="password" type="password" name="password" autocomplete="off" placeholder="Password"/>
                                        <input id="operation" type="hidden" name="operation" value="staff" />
                                        <input id="button" type="submit" name="submit" value="Log In"/>
                                    </form>

                                   
                            </div>
                        </div>

                        <script type="text/javascript">
                            $('.toggle').click(function(){
                              // Switches the Icon
                              $(this).children('i').toggleClass('fa-pencil');
                              // Switches the forms
                              $('.form').animate({
                                height: "toggle",
                                'padding-top': 'toggle',
                                'padding-bottom': 'toggle',
                                opacity: "toggle"
                              }, "slow");
                            });
                        </script>
                        <?php
                            }
                            else{
                        ?>
                        <img src="img/logo.png" alt="logo"/>
                        <?php
                            }
                        ?>
                    </div>

                  
                </div>
            </div>
        </section>

       

    
       

       
<!-- Modal For Event -->


<!--Modal For Register-->



<script src="js/moment.min.js"></script>
<script src="js/fullcalendar.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.portfolio-box', function(){
            var id = $(this).attr("id");

            $.ajax({
                url:"modules/admin/datatable/class/fetch_category.php",
                method:"POST",
                data:{id:id},
                dataType:"JSON",
                success:function(data)
                {
                    //show modal
                    $('#servicesModal').modal('show');

                    //append for modal
                    $('#service-title').text(data.title);
                    $('#service-content-modal').empty();
                    $('#service-content-modal').append(data.tbl);
                }
            });
        });



      

        
        $(document).on('click', '.tips', function(){
            $('#tipsModal').modal('show');
        });
    });
</script>
