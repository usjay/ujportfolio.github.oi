<!DOCTYPE html>
<html>
<head>
    <title>Project Management</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Your CSS styles */
    </style>
</head>
<body>
    <div class="container">
        <!-- Your existing form and other elements -->
        
        <button id="viewProjectsButton">View Projects</button>
        <div id="projectsContainer"></div>
    </div>

    <script>
        $(document).ready(function() {
            $("#viewProjectsButton").click(function() {
                // Use AJAX to fetch and display projects
                $.ajax({
                    type: "GET",
                    url: "view_projects.php", // Replace with the actual file to retrieve projects
                    success: function(response) {
                        $("#projectsContainer").html(response);
                    }
                });
            });
        });
    </script>
</body>
</html>
