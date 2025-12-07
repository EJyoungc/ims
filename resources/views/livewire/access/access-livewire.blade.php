<div class="content-wrapper d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <!-- dev by Techlink360 -->
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-danger"> 403</h2>

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Access denied.</h3>

                <p>
                    You do not have the necessary permissions to view this page.
                    Please contact your system administrator if you believe this is an error.
                    Meanwhile, you may <a href="{{ url()->previous() }}">return to the previous page</a>.
                </p>

                {{-- The search form is typically for finding other pages, but for a 403 it might be less relevant.
                     Keeping it commented out for now, but can be re-added if needed.
                <form class="search-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" name="submit" class="btn btn-danger"><i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                --}}
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
</div>