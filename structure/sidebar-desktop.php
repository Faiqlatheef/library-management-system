    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="../index.php"><img class="main-logo" src="<?php echo"$url"?>/logo/logotext.jpg" width="200px" height="60px" alt="" /></a>
                <strong><a href="../index.php"><img src="<?php echo"$url"?>/logo/logo.jpg" width="45px" height="38px" alt="" /></a></strong>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">                     
                       
                        <?php 

                            if ($_SESSION['sessionu_type']=="Librarian" ) {
                                ?>

                                    <li>
                                        <a class="has-arrow" href="all-professors.html" aria-expanded="false"><span class="fa fa-users educate-professor icon-wrap"></span> <span class="mini-click-non">Users</span></a>
                                        <ul class="submenu-angle" aria-expanded="false">
                                            <li><a title="All Professors" href="<?php echo $url?>users/veiw_user_pro.php"><span class="mini-sub-pro">All Users</span></a></li>
                                            <li><a href="<?php echo $url?>users/add_user.php"><span class="mini-sub-pro">Add User</span></a></li>
                                        </ul>
                                    </li>

                                <?php
                              }

                        ?>

                        <?php 

                            if ($_SESSION['sessionu_type']=="Librarian" ) {
                                ?>
                                <li>
                                    <a class="has-arrow" href="all-courses.html" aria-expanded="false"><span class="fa fa-user educate-department icon-wrap"></span> <span class="mini-click-non">User type</span></a>
                                    <ul class="submenu-angle" aria-expanded="false">
                                        <li><a title="Departments List" href="<?php echo $url?>usertype/veiw_ut.php"><span class="mini-sub-pro"> All User types </span></a></li>
                                        <li><a title="Add Departments" href="<?php echo $url?>usertype/add_ut.php"><span class="mini-sub-pro">Add User types </span></a></li>
                                    </ul>
                                </li>
                                <?php
                              }

                        ?>

                        <?php 

                            if ($_SESSION['sessionu_type']=="Librarian" ) {
                                ?>
                                <li>

                                    <a class="has-arrow" href="all-courses.html" aria-expanded="false"><span class="fa fa-book educate-department icon-wrap"></span> <span class="mini-click-non">Books</span></a>
                                    <ul class="submenu-angle" aria-expanded="false">
                                        <li><a title="Departments List" href="<?php echo $url?>books/veiw_book_pro.php"><span class="mini-sub-pro"> All Books</span></a></li>
                                        <li><a title="Add Departments" href="<?php echo $url?>books/add_book.php"><span class="mini-sub-pro">Add Books</span></a></li>     
                                    </ul>
                                </li>
                                <?php
                            }
                        ?>

                        <?php 

                            if ($_SESSION['sessionu_type']=="Librarian" ) {
                                ?>
                                <li>
                                    <a class="has-arrow" href="all-courses.html" aria-expanded="false"><span class="fa fa-clipboard educate-department icon-wrap"></span> <span class="mini-click-non">Book type</span></a>
                                    <ul class="submenu-angle" aria-expanded="false">
                                        <li><a title="Departments List" href="<?php echo $url?>booktype/veiw_bt.php"><span class="mini-sub-pro"> All Book types </span></a></li>
                                        <li><a title="Add Departments" href="<?php echo $url?>booktype/add_bt.php"><span class="mini-sub-pro">Add Book types </span></a></li>
                                    </ul>
                                </li>
                                <?php
                              }

                        ?>

                        <li>
                            <a class="has-arrow" href="all-courses.html" aria-expanded="false"><span class="fa fa-stack-overflow educate-department icon-wrap"></span> <span class="mini-click-non">Book Reserve</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <?php 
                                    if ($_SESSION['sessionu_type']=="Librarian" ) {
                                        ?>
                                        <li><a title="Departments List" href="<?php echo $url?>reserve/veiw_r_book.php"><span class="mini-sub-pro">All Reserved Book </span></a></li>
                                        <?php
                                          }
                                        ?>
                                <li><a title="Add Departments" href="<?php echo $url?>reserve/veiw_r_book_pro.php"><span class="mini-sub-pro">Reserve Book </span></a></li>
                            </ul>
                        </li>


                        <?php 

                            if ($_SESSION['sessionu_type']=="Librarian" ) {
                                ?>
                                <li>
                                    <a class="has-arrow" href="all-courses.html" aria-expanded="false"><span class="fa fa-briefcase educate-department icon-wrap"></span> <span class="mini-click-non">Book Lend</span></a>
                                    <ul class="submenu-angle" aria-expanded="false">
                                        <li><a title="Departments List" href="<?php echo $url?>lend/veiw_lend.php"><span class="mini-sub-pro"> All Lent Books </span></a></li>
                                        <li><a title="Add Departments" href="<?php echo $url?>lend/veiw_l_book.php"><span class="mini-sub-pro">Add Book Lend </span></a></li>
                                    </ul>
                                </li>
                                <?php
                              }

                        ?>
                        
                        <?php 

                            if ($_SESSION['sessionu_type']=="Librarian" ) {
                                ?>
                                <li>
                                    <a class="has-arrow" href="all-courses.html" aria-expanded="false"><span class="fa fa-refresh educate-department icon-wrap"></span> <span class="mini-click-non">Book Return</span></a>
                                    <ul class="submenu-angle" aria-expanded="false">
                                        <li><a title="Departments List" href="<?php echo $url?>return/veiw_return.php"><span class="mini-sub-pro"> All Return Book </span></a></li>
                                        <li><a title="Add Departments" href="<?php echo $url?>return/veiw_re_book.php"><span class="mini-sub-pro">Add Book Return </span></a></li>
                                    </ul>
                                </li>
                                <?php
                              }

                        ?>
                        
                        <?php 

                            if ($_SESSION['sessionu_type']=="Librarian" ) {
                                ?>
                                <li>
                                    <a class="has-arrow" href="all-courses.html" aria-expanded="false"><span class="fa fa-money educate-department icon-wrap"></span> <span class="mini-click-non">Fine</span></a>
                                    <ul class="submenu-angle" aria-expanded="false">
                                        <li><a title="Departments List" href="<?php echo $url?>fine/veiw_fine.php"><span class="mini-sub-pro"> All Fine </span></a></li>
                                    </ul>
                                </li>
                                <?php
                              }

                        ?>
                        

                    </ul>
                </nav>
            </div>
        </nav>
    </div>