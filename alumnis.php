<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>BVIMIT</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top header-transparent">
        <div class="container d-flex align-items-center justify-content-between position-relative">
            <div class="logo">
                <h1 class="text-light"><a href="index.html"><span>BVIMIT</span></a></h1>
            </div>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="./index.html">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About Us</a></li>
                    <li><a class="nav-link scrollto" href="faculties.html">Faculties</a></li>
                    <li class="dropdown"><a href="./alumnis.php"><span>Our Alumnis</span> <i
                                class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="./alumnis.php">View Alumni Profile</a></li>
                            <li><a href="gallery.html">Gallery</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="#contact">Contact Us</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar -->
        </div>
    </header>
    <!-- End Header -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
        <div class="container" data-aos="zoom-in">
            <div class="text-center">
                <h1 style="font-weight:700;">Our Alumnis</h1>
            </div>
        </div>
    </section>
    <!-- End Cta Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container">
            <div class="section-title" data-aos="fade-in" data-aos-delay="100">
                <h2>BVIMIT</h2>
                <h5>Alumnis aim to help school or college staff recognize the contribution of their ex-students in the
                    professional world. They donate their valuable time to offer career support to current students.
                    This enhances the students' experience and gives them that competitive edge in today's tough job
                    market. The alumni network of a college is one of the biggest sources of placement opportunities to
                    the students, and so BVIMIT always tries to appreciate all our alumnis. Also, they can get connected
                    with the principals and other school staff.</h5>
            </div>
            <div class="row" data-aos="fade-in">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <?php
                        $servername = "localhost"; // Adjust if necessary
                        $username = "root"; // Adjust if necessary
                        $password = ""; // Adjust if necessary
                        $dbname = "alumini"; // Adjust if necessary

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql_years = "SELECT DISTINCT batch FROM data";
                        $result_years = $conn->query($sql_years);

                        if ($result_years->num_rows > 0) {
                            while ($row_year = $result_years->fetch_assoc()) {
                                $year = $row_year['batch'];
                                echo '<li data-filter=".filter-' . $year . '">' . $year . '</li>';
                            }
                        }

                        $conn->close();
                        ?>
                    </ul>
                </div>
            </div>
            <div class="row portfolio-container" data-aos="fade-up">
                <?php
                // Re-establish the database connection for portfolio items
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $filter = isset($_GET['filter']) ? $_GET['filter'] : '*';

                $sql = "SELECT id, name, batch, org, deg, pic FROM data";

                if ($filter !== '*') {
                    $sql .= " WHERE batch = '$filter'";
                }

                $result = $conn->query($sql);

                if (!$result) {
                    die("Error in the SQL query: " . $conn->error);
                }

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $batch = $row['batch'];
                        $deg = $row['deg'];
                        $org = $row['org'];
                        $pic = $row['pic'];
                        ?>
                        <div class="col-lg-3 col-md-5 portfolio-item filter-<?php echo $batch; ?>">
                            <div class="portfolio-wrap">
                                
                                <img src="<?php echo "./Admin/myfile/".$row['pic']?>" class="img-fluid" style="max-width: 100%; height: 20%;" alt="Profile Picture">

                                <div class="portfolio-links">
                                    <a href="assets/img/portfolio/portfolio-1.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="2020 1"><i class="bx bxl-linkedin"></i></a>
                                    <a href="assets/img/portfolio/portfolio-1.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="2020 1"><i class="bx bxl-instagram"></i></a>
                                </div>
                            </div>
                            <div style="background-color: rgb(255, 232, 156); width: 99.5%; height: 130px; margin-top: 6px; margin-bottom: 2px;">
                                <h5><b>Name  : </b><?php echo $row['name']; ?></h5>
                                <h5><b>Batch : </b><?php echo $row['batch']; ?></h5>
                                <h5><b>Designation : </b><?php echo $row['deg']; ?></h5>
                                <h5><b>Organization : </b><?php echo $row['org']; ?></h5>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No results found.</p>";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </section>
    <!-- End Portfolio Section -->

    <script>
    $(document).ready(function () {
        // Handle click event on filter items
        $('#portfolio-flters li').on('click', function () {
            var filterValue = $(this).attr('data-filter');
            filterAlumni(filterValue);
        });

        // Initial display of all items
        filterAlumni('*');

        function filterAlumni(filterValue) {
            // Show/hide items based on the selected filter
            $('.portfolio-item').each(function () {
                if (filterValue === '*' || $(this).is(filterValue)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            // Update the active class for the filter items
            $('#portfolio-flters li').removeClass('filter-active');
            $('#portfolio-flters li[data-filter="' + filterValue + '"]').addClass('filter-active');
        }
    });
    </script>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
