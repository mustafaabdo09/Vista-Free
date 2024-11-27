<!-- Start - Search Section -->
<section class="Search-section">
    <div class="container search-container">
        <div class="search-form">
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="text" name="s" placeholder="Enter keywords for search..." onkeypress="if(event.key === 'Enter'){this.form.submit();}">
                <button type="submit"><i class="fa-solid fa-search"></i></button>
            </form>
         </div>

                <!-- الفئات الديناميكية -->
            <div class="mune-search">
                <ul>
                <?php
                // جلب الفئات وعرضها بشكل ديناميكي
                $categories = get_categories(array(
                    'hide_empty' => false, // لإظهار الفئات حتى وإن كانت فارغة
                ));
                
                // التحقق مما إذا كانت هناك فئات
                if ($categories) {
                    foreach ($categories as $category) {
                        echo '<li><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></li>';
                    }
                } else {
                    echo '<li>No categories found.</li>'; // في حالة عدم وجود فئات
                }
                ?>
                </ul>
            </div>
        </div>
</section>
<!-- End - Search Section -->

