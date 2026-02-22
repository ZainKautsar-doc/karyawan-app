            </div> <!-- End content-area -->
            
            <div class="admin-footer">
                Copyright &copy; <?= date("Y") ?> All rights reserved.
            </div>
            
        </div> <!-- End main-content -->
    </div> <!-- End admin-layout -->

    <script>
        lucide.createIcons();
        // Simple toggle for mobile sidebar
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>
