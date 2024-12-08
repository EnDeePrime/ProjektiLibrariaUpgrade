<?php 
session_start();

# Database Connection File
include "NEWPHP/db_conn.php";

# Book helper function
include "NEWPHP/php/func-book.php";
$books = get_all_books($conn);

# author helper function
include "NEWPHP/php/func-author.php";
$authors = get_all_author($conn);

# Category helper function
include "NEWPHP/php/func-category.php";
$categories = get_all_categories($conn);

 ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furniture Paradise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="stylenew.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />
    
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">

            <a class="navbar-brand" href="#"> <img style="height: 90px;" src="image/logo.png" alt="">KS-Library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">My Account</a></li>
                    <li class="nav-item">
                        <div class="dropdown1">
                        <a class="nav-link" href="#"> Location<a>
                        </button>
                        <div class="dropdown1-content">
                          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2934.4627201470985!2d21.15214808568595!3d42.651548896824316!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13549eec30b18cd1%3A0x238cfa3986cd3829!2sEducational%20Centre%20Kosova!5e0!3m2!1sen!2s!4v1703182378390!5m2!1sen!2s" width="420" height="315" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                      </li>
                    <li class="nav-item"><a class="nav-link" href="NEWPHP/login.php">Log in</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Get Library Card</a></li>
                    <li class="nav-item"> <a href="emailSignUp.html" class="nav-link">Get Email Updates</a></li>
    
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                   
                    <li class="nav-item"><a  id="NormalShop" class="nav-link" href="https://libraria-ks-shop.netlify.app/">Shop</a></li>
                    <div class="dropdown">
                        <button class="dropbtn">Quick Navigate
                          <i class="fa fa-caret-down"></i>
                        </button>
                        <div  class="dropdown-content">
                          <li class="quicknavigate"><a  href="#Home">About Us</a></li>
                         
                          <li class="quicknavigate"><a  href="#Arrivals">Arrivals</a></li>
                          <li class="quicknavigate"><a  href="#Reviews">Reviews</a></li>
                          <li class="quicknavigate"><a  href="#Blog">Blog</a></li>
                        </div>
                      </div> 
            </div>
        </div>
    </nav>
    <section id="Home" >
    
    <div class="main">
        <div class="main_tag">
          <h1>WELCOME TO<br /><span>Our Library</span></h1>

          <p>
            Welcome to Libraria-KS a literary sanctuary where stories
            unfold and reading becomes an immersive journey.Our curated
            collection spans genres and eras,offering something for every
            reader.Dive into our blog for insightful reviews and author
            interviews,and explore our latest arrivals that promise to ignite
            your curiosity.Libraria-KS is more than a bookshop it's a
            community of passionate readers celebrating the joy of
            storytelling.Join us on this literary adventure welcome to your home
            for all things books!
          </p>
          <a href="#" class="main_btn">Learn More</a>
        </div>

        <div class="main_img">
          <img src="image/table.png" />
        </div>
      </div>
      
    </section>
    
    <!--Services-->
    <div class="bannerTop">
      |<p>Why is the freedom to read important to you? At a time of rising book bans and censorship, Libraria-KS invites teens across Kosovo, Macedonia and Albania to enter our national writing contest exploring this essential right. The grand prize winner will be awarded $500, and 20 additional winners will receive $250 each. Plus, Teen Vogue will publish the grand prize-winning entry in the spring of 2024! Libraria-KS will also publish all winning entries in a special edition of our Teen Voices magazine.<a href="https://www.surveymonkey.com/r/6B9977Y">Enter now!</a> </p>
      
    </div>
</section id="Top">
<!-- from here new---->

<!--- end new--->

<?php $max_books = 10;

// Initialize a counter to limit the number of iterations
$counter = 0;

foreach ($books as $book) {
   
    if ($counter >= $max_books) {
        break;
    }
  }
    // Increment the counter
    $counter++;
    ?>
    
       
    <div class="featured_boks">
    <h1>Featured Books</h1>
    <div class="featured_book_box">
        <?php if (empty($books)) { ?>
            <div class="alert alert-warning text-center p-5" role="alert">
                <img src="NEWPHP/img/empty.png" width="100">
                <br>
                There is no book in the database
            </div>
        <?php } else { ?>
            <?php foreach ($books as $book) { ?>
                <?php if ($book['recommended'] == 1) { ?>
                    <div class="featured_book_card">
                        <img src="NEWPHP/uploads/cover/<?= $book['cover'] ?>" alt="Book Cover">
                        <div class="book_details">
                        
                            <a href="NEWPHP/uploads/files/<?= $book['file'] ?>" class="btn btn-success">Open</a>
                            <a href="uploads/files/<?= $book['file'] ?>" class="btn btn-primary" download="<?= $book['title'] ?>">Download</a>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>
</div>

                      
<!---Temporary from Library ND-->
<div class="featured_boks">
      <h1>Free Books</h1>
     
      <div class="featured_book_box">
        <div class="featured_book_card">
          <div class="featurde_book_img">
            <img src="image\PhantomOfTheOperajpg.jpg" />
          </div>

          <div class="featurde_book_tag">
            <h2>Phantom Of The Opera</h2>
            <div class="categories"> Novel, Horror fiction, Gothic fiction, Urban fiction</div>
         
         
            <a href="https://archive.org/details/phantomofopera00lero/page/n3/mode/2up?ref=ol&view=theater" class="btn btn-primary">Read</a>
          </div>
        </div>

        <div class="featured_book_card">
          <div class="featurde_book_img">
            <img src="image\SamuelButlerASketch.jpg" />
          </div>

          <div class="featurde_book_tag">
            <h2>A Sketch of Samule Buttler</h2>
            <div class="categories"> Auto-Biography, Utopian fiction, Social commentary, Science fiction</div>

         
            </p>
            <a href="https://archive.org/details/phantomofopera00lero/page/n3/mode/2up?ref=ol&view=theater" class="btn btn-primary">Read</a>
          </div>
          
        </div>

        <div class="featured_book_card">
          <div class="featurde_book_img">
            <img src="image\PrideAndPrejudice.jpg" />
          </div>

          
          <div class="featurde_book_tag">
            <h2>Pride and Prejudice</h2>
            <div class="categories"> Romance, Regency-era fiction, Social commentary</div>
          
          
            <a href="https://archive.org/details/phantomofopera00lero/page/n3/mode/2up?ref=ol&view=theater" class="btn btn-primary">Read</a>
          </div>
        </div>

        <div class="featured_book_card">
          <div class="featurde_book_img">
            <img src="image\TheArtOfWar.jpg" />
          </div>
          <h2>The Art of War</h2>
            <div class="categories"> Military strategy, Philosophy, Political theory, Leadership.</div>
          
         
          <div class="featurde_book_tag">

            <a href="https://archive.org/details/phantomofopera00lero/page/n3/mode/2up?ref=ol&view=theater" class="btn btn-primary">Read</a>
          </div>
         
        </div>

        <div class="featured_book_card">
          <div class="featurde_book_img">
            <img src="image\TheHunchbackofNotredame.jpg" />
          </div>

          <div class="featurde_book_tag">
          <h2>The Hunchback of Notredame</h2>
            <div class="categories"> Gothic fiction, Historical fiction, Social commentary, Tragedy.</div>
         
            </p>
            <a href="https://archive.org/details/phantomofopera00lero/page/n3/mode/2up?ref=ol&view=theater" class="btn btn-primary">Read</a>
          </div>
        </div>

        <div class="featured_book_card">
          <div class="featurde_book_img">
            <img src="image/book_6.jpg" />
          </div>

          <div class="featurde_book_tag">
            <h2>Featured Books</h2>
            <p class="writer">Toni Morrison</p>
            <div class="categories">Thriller, Horror, Romance</div>
            <p class="book_price"></p>
            <a href="#" class="f_btn">Order Now!</a>
          </div>
        </div>

        <div class="featured_book_card">
          <div class="featurde_book_img">
            <img src="image/book_7.png" />
          </div>

          <div class="featurde_book_tag">
            <h2>Featured Books</h2>
            <p class="writer">George Orwell</p>
            <div class="categories">Thriller, Horror, Romance</div>
            <p class="book_price"></p>
            <a href="#" class="f_btn">Order Now!</a>
          </div>
        </div>

        <div class="featured_book_card">
          <div class="featurde_book_img">
            <img src="image/book_8.png" />
          </div>

          <div class="featurde_book_tag">
            <h2>Featured Books</h2>
            <p class="writer">Chimamanda Ngozi</p>
            <div class="categories">Thriller, Horror, Romance</div>
            <p class="book_price"></p>
            <a href="#" class="f_btn">Order Now!</a>
          </div>
        </div>

        <div class="featured_book_card">
          <div class="featurde_book_img">
            <img src="image/book_9.jpg" />
          </div>

          <div class="featurde_book_tag">
            <h2>Featured Books</h2>
            <p class="writer">Ernest Hemingway</p>
            <div class="categories">Thriller, Horror, Romance</div>
            <p class="book_price"></p>
            <a href="#" class="f_btn">Order Now!</a>
          </div>
        </div>

        <div class="featured_book_card">
          <div class="featurde_book_img">
            <img src="image/book_10.png" />
          </div>

          <div class="featurde_book_tag">
            <h2>Featured Books</h2>
            <p class="writer">Agatha Christie</p>
            <div class="categories">Thriller, Horror, Romance</div>
            <p class="book_price"></p>
            <a href="#" class="f_btn">Order Now!</a>
          </div>
        </div>

        <div class="featured_book_card">
          <div class="featurde_book_img">
            <img src="image/book_11.jpg" />
          </div>

          <div class="featurde_book_tag">
            <h2>Featured Books</h2>
            <p class="writer">Gabriel Marquez</p>
            <div class="categories">Thriller, Horror, Romance</div>
            <p class="book_price"></p>
            <a href="#" class="f_btn">Order Now!</a>
          </div>
        </div>

        <div class="featured_book_card">
          <div class="featurde_book_img">
            <img src="image/book_12.png" />
          </div>

          <div class="featurde_book_tag">
            <h2>Featured Books</h2>
            <p class="writer">Roald Dahl</p>
            <div class="categories">Thriller, Horror, Romance</div>
            <p class="book_price"></p>
            <a href="#" class="f_btn">Order Now!</a>
          </div>
        </div>

        <div class="featured_book_card">
          <div class="featurde_book_img">
            <img src="image/book_13.png" />
          </div>

          <div class="featurde_book_tag">
            <h2>Featured Books</h2>
            <p class="writer">Virginia Woolf</p>
            <div class="categories">Thriller, Horror, Romance</div>
            <p class="book_price"></p>
            <a href="#" class="f_btn">Order Now!</a>
          </div>
        </div>

        <div class="featured_book_card">
          <div class="featurde_book_img">
            <img src="image/book_14.png" />
          </div>

          <div class="featurde_book_tag">
            <h2>Featured Books</h2>
            <p class="writer">Salman Rushdie</p>
            <div class="categories">Thriller, Horror, Romance</div>
            <p class="book_price"></p>
            <a href="#" class="f_btn">Order Now!</a>
          </div>
        </div>

        <div class="featured_book_card">
          <div class="featurde_book_img">
            <img src="image/book_15.png" />
          </div>

          <div class="featurde_book_tag">
            <h2>Featured Books</h2>
            <p class="writer">J.R.R. Tolkien</p>
            <div class="categories">Thriller, Horror, Romance</div>
            <p class="book_price"></p>
            <a href="#" class="f_btn">Order Now!</a>
          </div>
        </div>
      </div>
    </div>
    <!--Arrivals-->
<section id="Arrivals">
    <div class="arrivals">
      <h1>New Arrivals</h1>

      <div class="arrivals_box">
        <div class="arrivals_card">
          <div class="arrivals_image">
            <img src="image/arrival_1.jpg" />
          </div>
          <div class="arrivals_tag">
            <p>The Giver</p>
            <div class="arrivals_icon">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
             
              <i class="fa-solid fa-star-half-stroke"></i>
            </div>
            <a href="#" class="arrivals_btn">Learn More</a>
          </div>
        </div>

        <div class="arrivals_card">
          <div class="arrivals_image">
            <img src="image/arrival_2.jpg" />
          </div>
          <div class="arrivals_tag">
            <p>The wright Brothers</p>
            <div class="arrivals_icon">
             
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
            <a href="#" class="arrivals_btn">Learn More</a>
          </div>
        </div>

        <div class="arrivals_card">
          <div class="arrivals_image">
            <img src="image/arrival_3.jpg" />
          </div>
          <div class="arrivals_tag">
            <p>Radical Gardening</p>
            <div class="arrivals_icon">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
            <a href="#" class="arrivals_btn">Learn More</a>
          </div>
        </div>

        <div class="arrivals_card">
          <div class="arrivals_image">
            <img src="image/arrival_4.jpg" />
          </div>
          <div class="arrivals_tag">
            <p>Red Queen</p>
            <div class="arrivals_icon">
              <i class="fa-solid fa-star"></i>
            
              <i class="fa-solid fa-star-half-stroke"></i>
            </div>
            <a href="#" class="arrivals_btn">Learn More</a>
          </div>
        </div>

        <div class="arrivals_card">
          <div class="arrivals_image">
            <img src="image/arrival_5.jpg" />
          </div>
          <div class="arrivals_tag">
            <p>To Kill a Mocking Bird</p>
            <div class="arrivals_icon">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star-half-stroke"></i>
            </div>
            <a href="#" class="arrivals_btn">Learn More</a>
          </div>
        </div>

        <div class="arrivals_card">
          <div class="arrivals_image">
            <img src="image/arrival_6.jpg" />
          </div>
          <div class="arrivals_tag">
            <p>Harry Potter </p>
            <div class="arrivals_icon">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
            <a href="#" class="arrivals_btn">Learn More</a>
          </div>
        </div>

        <div class="arrivals_card">
          <div class="arrivals_image">
            <img src="image/arrival_7.jpg" />
          </div>
          <div class="arrivals_tag">
            <p>Heroes of olympus</p>
            <div class="arrivals_icon">
           
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star-half-stroke"></i>
            </div>
            <a href="#" class="arrivals_btn">Learn More</a>
          </div>
        </div>

        <div class="arrivals_card">
          <div class="arrivals_image">
            <img src="image/arrival_8.webp" />
          </div>
          <div class="arrivals_tag">
            <p>Diary Of A Wimpy Kid</p>
            <div class="arrivals_icon">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
             
            </div>
            <a href="#" class="arrivals_btn">Learn More</a>
          </div>
        </div>

        <div class="arrivals_card">
          <div class="arrivals_image">
            <img src="image/arrival_9.jpg" />
          </div>
          <div class="arrivals_tag">
            <p>Ranger's apprentice</p>
            <div class="arrivals_icon">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
            <a href="#" class="arrivals_btn">Learn More</a>
          </div>
        </div>

        <div class="arrivals_card">
          <div class="arrivals_image">
            <img src="image/arrival_10.jpg" />
          </div>
          <div class="arrivals_tag">
            <p>Percy Jackson</p>
            <div class="arrivals_icon">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star-half-stroke"></i>
            </div>
            <a href="#" class="arrivals_btn">Learn More</a>
          </div>
        </div>
      </div>
    </div>
  </section>
    <!--reviews-->
    <section id="Reviews">
      

    <div class="reviews">
      <h1>Reviews</h1>
      <div class="">
     
        
      </div>
      <div class="review_box">
        <div class="review_card">
          <i class="fa-solid fa-quote-right"></i>
          <div class="card_top">
            <img src="image/review_1.png" />
          </div>
          <div class="card">
            <h2>Ethan</h2>
            <p>
              "A bibliophile's paradise!Libraria-KS caters to every
              taste—impeccable service."
            </p>
            <div class="review_icon">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
          </div>
        </div>

        <div class="review_card">
          <i class="fa-solid fa-quote-right"></i>
          <div class="card_top">
            <img src="image/review_2.png" />
          </div>
          <div class="card">
            <h2>Sarah</h2>
            <p>
              "Libraria-KS—where books find a home. Exceptional
              variety,cozy ambiance.This is the best bookshop
            </p>
            <div class="review_icon">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
             
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star-half-stroke"></i>
            </div>
          </div>
        </div>

        <div class="review_card">
          <i class="fa-solid fa-quote-right"></i>
          <div class="card_top">
            <img src="image/review_3.png" />
          </div>
          <div class="card">
            <h2>Xavier</h2>
            <p>
              "This Bookshop delivers joy with every purchase. Impeccable
              service, diverse collection. A reliable and delightful book
              haven."
            </p>
            <div class="review_icon">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
             
            </div>
          </div>
        </div>

        <div class="review_card">
          <i class="fa-solid fa-quote-right"></i>
          <div class="card_top">
            <img src="image/review_4.png" />
          </div>
          <div class="card">
            <h2>Jessica</h2>
            <p>
              "I gotta say their online convenience is unmatched.Swift delivery,secure transactions.An ideal bookstore for bookworms on
              the go!"
            </p>
            <div class="review_icon">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
 
   
 <section id="Blog"> 
    <div class="blog">
      <h1>Our Blog</h1>
      <div class="blog_box">
        <div class="blog_card">
          <a href="https://libraria-ks.blogspot.com/" target="_blank">
          <div class="blog_img">
            <img src="image/blog_1.jpg" />
          </div>
          <div class="blog_tag">
            <h2>Explore the Ks-Library Blog </h2>
            <p>
              Hey there! Our blog is a treasure trove of cool stuff for you to dive into, Find reviews, recommendations and discussions on there.Our blog is a treasure trove of cool stuff for you to dive into. Whether you're into detailed reviews that give you the lowdown, personalized recommendations to match your vibe, or just love joining in on lively discussions, we've got it all. It's more than a blog – it's a place to explore, connect, and be in the know. Come join the fun!
            </p>
            <div class="blog_icon">
              <i class="fa-solid fa-calendar-days"></i>
              <i class="fa-solid fa-heart"></i>
            </div>
          </div>
        </a>
        </div>

        <div class="blog_card">
          <a href="https://libraria-ks.blogspot.com/" target="_blank">
          <div class="blog_img">
           
            <img src="image/blog_2.jpg" />
          </div>
          <div class="blog_tag">
            <h2>Book of the week - "Catherine House" </h2>
            <p>
              A gothic-infused debut of literary suspense, set within a secluded, elite university and following a dangerously curious, rebellious undergraduate who uncovers a shocking secret about an exclusive circle of students . . . and the dark truth beneath her school's promise of prestige.
            </p>
            <div class="blog_icon">
              <i class="fa-solid fa-calendar-days"></i>
              <i class="fa-solid fa-heart"></i>
            </div>
            </a>
          </div>
       
        </div>

        <div class="blog_card">
          <div class="blog_img">
            <a href="https://libraria-ks.blogspot.com/" target="_blank">
            <img src="image/blog_3.jpg" />
          </div>
          <div class="blog_tag">
            <h2>Book review : "The Switch"</h2>
            <p>
              The Switch follows Leena and her grandmother Eileen who are struggling in their daily lives and in need of a change. So they decide to swap lives, with Eileen trying online dating in London, and Leena going back to her rural home village. This was just the charming and easy read that I needed right now.
            </p>
            <div class="blog_icon">
              <i class="fa-solid fa-calendar-days"></i>
              <i class="fa-solid fa-heart"></i>
            </div>
          </div>
        </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Updated anchor tag with the external link -->
 
</div>
</section>
    
   
       
    <footer>
        <div class="footer_main">
            <div class="row">
                <!-- Left Column (Image and Description) -->
                <div class="col-12 col-md-4">
                    <div class="tag" style="margin-right:20px;">
                        <div id="imagefooter">
                            <img src="image/NYPL_MainFacadeRev2Cam2.png" alt="NYPL">
                            <p>Stay updated on the latest literary events and news. From book launches to literary festivals, our blog keeps you in the loop, ensuring you never miss an opportunity to celebrate your love for literature.</p>
                        </div>
                    </div>
                </div>
    
                <!-- Middle Column (Form) -->
                <div class="col-12 col-md-4">
                    <form action="https://formspree.io/f/mnqeagob" method="POST" class="cf">
                        <div class="half left cf">
                            <input type="text" name="name" id="input-name" placeholder="Full Name">
                            <input type="email" name="email" id="input-email" placeholder="Email address">
                            <input type="text" name="subject" id="input-subject" placeholder="Subject">
                        </div>
                        <div class="half right cf">
                            <textarea name="message" id="input-message" placeholder="Message"></textarea>
                        </div>
                        <input type="submit" value="Submit" id="input-submit">
                    </form>
                </div>
    
                <!-- Right Column (Follow Us and Newsletter on the same line) -->
                <div class="col-12 col-md-4">
                    <div class="d-flex justify-content-between">
                        <!-- Follow Us Section -->
                        <div class="tag">
                            <h1 class="follow" style="text-align: center; font-size: 25px;">Follow Us</h1>
                            <div class="social_link" style="text-align: center;">
                                <i class="fa-brands fa-facebook-f" onclick="window.open('https://www.facebook.com/profile.php?id=61554730603792', '_blank')"></i>
                                <i class="fa-brands fa-instagram" onclick="window.open('https://www.instagram.com/librariaaaks?utm_source=ig_web_button_share_sheet&igsh=OGQ5ZDc2ODk2ZA==', '_blank')"></i>
                                <i class="fa-brands fa-twitter" onclick="window.open('https://twitter.com', '_blank')"></i>
                                <i class="fa-brands fa-linkedin-in" onclick="window.open('https://www.linkedin.com/in/libraria-ks-91313a2a7/', '_blank')"></i>
                            </div>
                        </div>
    
                        <!-- Newsletter Section -->
                        <div class="tag">
                            <h1 style="text-align: center;">Newsletter</h1>
                            <div class="search_bar">
                                <input type="text" placeholder="Your email id here">
                                <button type="submit">Subscribe</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <p class="end">
            Copyright reserved © 2023
          </p>
    </footer>
    
    <script>
      document.querySelectorAll('.read-more-btn').forEach((button) => {
    button.addEventListener('click', () => {
        const textContainer = button.previousElementSibling;
        textContainer.classList.toggle('expanded');

        // Toggle button text
        if (textContainer.classList.contains('expanded')) {
            button.textContent = 'Read Less';
        } else {
            button.textContent = 'Read More';
        }
    });
});

        document.addEventListener("DOMContentLoaded", function () {
            // Get all links with the class 'scroll-link'
            const scrollLinks = document.querySelectorAll('.nav-items a');
          
            // Attach click event listener to each link
            scrollLinks.forEach(link => {
              link.addEventListener('click', function (e) {
                e.preventDefault();
          
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
          
                if (targetElement) {
                  // Scroll to the target element smoothly
                  targetElement.scrollIntoView({
                    behavior: 'smooth'
                  });
                }
              });
            });
          });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
