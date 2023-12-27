    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/jquery.js"></script>
    <script src="../../public/js/menu.js"></script>
    <script src="../../public/js/app.js"></script>
    <script src="../../public/js/toast.js"></script>
    <?php 
        function addScript($name) {
            foreach($name as $script) {
                echo '<script src="'.'../../public/js/'.$script.'.js"></script>';    
            }
        }
    ?> 
</body>

</html>