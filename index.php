<!DOCTYPE html>
<html>
<head>
    <title>System Stats</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>System Stats</h1>
    <div id="stats">
        <!-- Display data here -->
    </div>

    <script>
        function updateStats() {
            $.ajax({
                url: 'get_stats.php', // PHP script to fetch data
                success: function(data) {
                    $('#stats').html(data);
                }
            });
        }

        // Initial load and periodic updates
        updateStats();
        setInterval(updateStats, 5000); // Update every 5 seconds
    </script>
</body>
</html>
