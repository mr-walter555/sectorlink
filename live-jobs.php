<?php
// Add this at the very top of the file
session_start();

// Check if PDO connection exists, if not, include database connection
if (!isset($pdo)) {
    require_once 'config/database.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Jobs | Sector</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* Mobile sidebar styles */
        @media (max-width: 991.98px) {
            .filters-sidebar {
                position: fixed;
                top: 0;
                left: -100%;
                width: 80%;
                max-width: 300px;
                height: 100vh;
                background: white;
                z-index: 1000;
                padding: 20px;
                overflow-y: auto;
                transition: left 0.3s ease-in-out;
                box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            }

            .filters-sidebar.show {
                left: 0;
            }

            .mobile-filter-toggle {
                display: block;
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 999;
            }
        }

        /* Hide mobile toggle on desktop */
        @media (min-width: 992px) {
            .mobile-filter-toggle {
                display: none;
            }
        }
    </style>
</head>

<body>
    <?php include 'components/navbar.php'; ?>
    <section class="about-hero">

        <div class="container">

            <div class="about-hero-content" style="height: 25vh;">
                <h1>Discover Your Dream Jobs</h1>
                <div class="search-container">
                    <form id="searchForm" class="search-box">
                        <div class="search-field">
                            <i class="fas fa-search"></i>
                            <input type="text" name="keyword" placeholder="keywords...">
                        </div>
                        <div class="search-field">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" name="location" placeholder="Location">
                        </div>
                        <div class="search-field">
                            <i class="fas fa-briefcase"></i>
                            <select name="job_type">
                                <option value="">All Job Types</option>
                                <option value="Full-Time" <?php echo isset($_GET['job_type']) && $_GET['job_type'] === 'Full-Time' ? 'selected' : ''; ?>>Full Time</option>
                                <option value="Part-Time" <?php echo isset($_GET['job_type']) && $_GET['job_type'] === 'Part-Time' ? 'selected' : ''; ?>>Part Time</option>
                                <option value="Contract" <?php echo isset($_GET['job_type']) && $_GET['job_type'] === 'Contract' ? 'selected' : ''; ?>>Contract</option>
                                <option value="Remote" <?php echo isset($_GET['job_type']) && $_GET['job_type'] === 'Remote' ? 'selected' : ''; ?>>Remote</option>
                            </select>
                        </div>
                        <button class="search-btn" type="button" onclick="loadJobs()">
                            <i class="fas fa-search"></i>
                            Search
                        </button>
                    </form>
                </div>
            </div>


        </div>


    </section>
    <section class="jobs-with-filters">
        <div class="container">
            <div class="row">
                <!-- Sidebar Filters -->
                <div class="col-lg-3">
                    <div class="filters-sidebar">
                        <form id="filterForm" method="GET">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2 class="filters-title mb-0">Refine Search</h2>
                                <button type="button" class="btn btn-link text-secondary p-0" onclick="clearAllFilters()">
                                    <i class="fas fa-times me-1"></i>Clear all
                                </button>
                            </div>
                            <div class="filter-group">
                                <h3>Salary Range</h3>
                                <div class="checkbox-group">
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="salary_range[]" value="0-30000">
                                        <span>£0 - £30,000</span>
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="salary_range[]" value="30000-50000">
                                        <span>£30,000 - £50,000</span>
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="salary_range[]" value="50000-80000">
                                        <span>£50,000 - £80,000</span>
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="salary_range[]" value="80000-120000">
                                        <span>£80,000 - £120,000</span>
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="salary_range[]" value="120000+">
                                        <span>£120,000+</span>
                                    </label>
                                </div>
                            </div>

                            <div class="filter-group">
                                <h3>Experience Level</h3>
                                <div class="checkbox-group">
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="experience[]" value="entry">
                                        Entry Level
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="experience[]" value="mid">
                                        Mid Level
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="experience[]" value="senior">
                                        Senior Level
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="experience[]" value="executive">
                                        Executive
                                    </label>
                                </div>
                            </div>
                            <div class="filter-group">
                                <h3>Industry</h3>
                                <div class="checkbox-group">
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="industry[]" value="healthcare">
                                        Healthcare
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="industry[]" value="it">
                                        Information Technology (IT)
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="industry[]" value="finance">
                                        Finance and Banking
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="industry[]" value="education">
                                        Education
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="industry[]" value="construction">
                                        Construction and Engineering
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="industry[]" value="hospitality">
                                        Hospitality and Tourism
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="industry[]" value="retail">
                                        Retail and E-commerce
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="industry[]" value="manufacturing">
                                        Manufacturing and Logistics
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="industry[]" value="legal">
                                        Legal
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="industry[]" value="creative">
                                        Creative and Media
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="industry[]" value="telecom">
                                        Telecommunications
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="industry[]" value="energy">
                                        Energy and Utilities
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="industry[]" value="government">
                                        Government and Public Sector
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="industry[]" value="pharmaceutical">
                                        Pharmaceutical and Life Sciences
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="industry[]" value="aviation">
                                        Aviation
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="industry[]" value="customerservice">
                                        Customer Service and Call Centers
                                    </label>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="col-lg-9">
                    <button class="btn btn-primary mobile-filter-toggle mb-3 d-lg-none" onclick="toggleFilters()">
                        <i class="fas fa-filter"></i> Show Filters
                    </button>
                    <div class="jobs-listing" id="jobsListingContainer">
                        <div class="job-card loading">
                            <div class="loading-spinner"></div>
                            <p>Loading jobs...</p>
                        </div>
                        <template id="job-card-template">
                            <div class="job-card">
                                <h3 class="job-title"></h3>
                                <div class="job-company"></div>
                                <div class="job-location"></div>
                                <div class="job-type"></div>
                                <div class="job-posted"></div>
                                <div class="job-description"></div>

                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="footer-container">
            <!-- Top Footer Section -->
            <div class="footer-top">
                <!-- Company Info -->
                <div class="footer-col">

                    <p class="footer-desc">
                        Sector Link Solutions is a pioneering recruitment company committed to helping organisations achieve their diversity and inclusion goals.
                    </p>

                </div>

                <!-- Quick Links -->
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="live-jobs.php">Live Jobs</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="footer-col">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="healthcare.php">Healthcare Staffing</a></li>
                        <li><a href="permanent.php">Permanent Recruitment</a></li>
                        <li><a href="temporary.php">Temporary Recruitment</a></li>
                    </ul>
                </div>
                <!-- Contact Info -->
                <div class="footer-col">
                    <h4>Contact Us</h4>
                    <div class="contact-info">
                        <p><i class="fas fa-envelope"></i>contact@sectorlinksolutions.ie</p>
                        <p><i class="fas fa-map-marker-alt"></i> Dublin, Ireland</p>
                    </div>

                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="footer-bottom">
                <div class="copyright">
                    <p>&copy; 2024 Your Company. All rights reserved.</p>
                </div>
                <div class="footer-links">
                    <a href="privacy.php">Privacy Policy</a>
                    <a href="terms-and-conditions.php">Terms of Service</a>
                    <a href="#">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>



    <!-- Add JavaScript before closing body tag -->


</body>

</html>

<script>
    function loadJobs() {
        // Get both forms
        const searchForm = document.getElementById('searchForm');
        const filterForm = document.getElementById('filterForm');

        // Combine both form data
        const searchData = new FormData(searchForm);
        const filterData = new FormData(filterForm);

        // Merge the form data
        const combinedData = new URLSearchParams();

        // Add search form data
        for (const [key, value] of searchData) {
            if (value) { // Only add if value is not empty
                combinedData.append(key, value);
            }
        }

        // Add filter form data - handle multiple selections for checkboxes
        const checkboxGroups = {};
        for (const [key, value] of filterData) {
            if (key.endsWith('[]')) {
                const baseKey = key.slice(0, -2);
                if (!checkboxGroups[baseKey]) {
                    checkboxGroups[baseKey] = [];
                }
                checkboxGroups[baseKey].push(value);
            } else if (value) { // Only add if value is not empty
                combinedData.append(key, value);
            }
        }

        // Add checkbox groups to combined data
        for (const [key, values] of Object.entries(checkboxGroups)) {
            values.forEach(value => {
                combinedData.append(`${key}[]`, value);
            });
        }

        const queryString = combinedData.toString();

        // Update URL without reloading the page
        window.history.pushState({}, '', `${window.location.pathname}?${queryString}`);

        // Show loading state
        document.getElementById('jobsListingContainer').innerHTML =
            '<div class="job-card loading"><div class="loading-spinner"></div><p>Loading jobs...</p></div>';

        // Fetch jobs
        fetch(`get-jobs.php?${queryString}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(html => {
                document.getElementById('jobsListingContainer').innerHTML = html;
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('jobsListingContainer').innerHTML =
                    '<div class="alert alert-danger">Error loading jobs. Please try again.</div>';
            });

        // Close mobile filters if open
        if (window.innerWidth < 992) {
            const filtersSidebar = document.querySelector('.filters-sidebar');
            if (filtersSidebar.classList.contains('show')) {
                toggleFilters();
            }
        }
    }

    function clearAllFilters() {
        // Clear search form
        document.getElementById('searchForm').reset();

        // Clear filter form
        document.getElementById('filterForm').reset();

        // Load jobs without filters
        loadJobs();
    }

    // Debounce function
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Initialize filters and form handlers
    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.getElementById('searchForm');
        const filterForm = document.getElementById('filterForm');

        // Prevent default form submissions
        searchForm.addEventListener('submit', (e) => {
            e.preventDefault();
            loadJobs();
        });
        
        filterForm.addEventListener('submit', (e) => {
            e.preventDefault();
            loadJobs();
        });

        // Add change event listeners to form elements
        const debouncedLoadJobs = debounce(() => loadJobs(), 500);

        // Handle text inputs with debounce
        document.querySelectorAll('input[type="text"]').forEach(input => {
            input.addEventListener('input', debouncedLoadJobs);
        });

        // Handle immediate updates for checkboxes, radios, and selects
        document.querySelectorAll('input[type="checkbox"], input[type="radio"], select').forEach(input => {
            input.addEventListener('change', () => loadJobs());
        });

        // Set initial values from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        
        // Set text input values
        urlParams.forEach((value, key) => {
            const input = document.querySelector(`input[name="${key}"], select[name="${key}"]`);
            if (input && !key.endsWith('[]')) {
                input.value = value;
            }
        });

        // Set checkbox values
        ['experience', 'industry', 'salary_range'].forEach(paramName => {
            urlParams.getAll(`${paramName}[]`).forEach(value => {
                const checkbox = document.querySelector(`input[name="${paramName}[]"][value="${value}"]`);
                if (checkbox) {
                    checkbox.checked = true;
                }
            });
        });

        // Load initial jobs
        loadJobs();
    });

    // Handle browser back/forward buttons
    window.addEventListener('popstate', () => {
        loadJobs();
    });

    function toggleFilters() {
        const filtersSidebar = document.querySelector('.filters-sidebar');
        const toggleButton = document.querySelector('.mobile-filter-toggle');
        const overlay = document.getElementById('sidebar-overlay');

        filtersSidebar.classList.toggle('show');
        
        if (filtersSidebar.classList.contains('show')) {
            toggleButton.innerHTML = '<i class="fas fa-times"></i> Hide Filters';
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        } else {
            toggleButton.innerHTML = '<i class="fas fa-filter"></i> Show Filters';
            document.body.style.overflow = ''; // Restore scrolling
        }
    }

    // Close filters when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const filtersSidebar = document.querySelector('.filters-sidebar');
        const toggleButton = document.querySelector('.mobile-filter-toggle');

        if (window.innerWidth < 992) {
            if (!filtersSidebar.contains(event.target) && 
                !toggleButton.contains(event.target) && 
                filtersSidebar.classList.contains('show')) {
                toggleFilters();
            }
        }
    });
</script>