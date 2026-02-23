<div>
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>About This System</h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- ================= SYSTEM OVERVIEW ================= -->
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">System Overview & Features</h3>
                        </div>
                        <div class="card-body">
                            <p>
                                This is a comprehensive <strong>Inventory Management System (IMS)</strong>
                                designed to streamline daily business operations and improve decision-making.
                            </p>

                            <ul>
                                <li><strong>User Management:</strong> Secure authentication, role-based access control, and user activity tracking.</li>
                                <li><strong>Product Management:</strong> Full CRUD, categorization, stock levels, barcode support, and reorder alerts.</li>
                                <li><strong>Supplier Management:</strong> Supplier records, contact tracking, and blacklist support.</li>
                                <li><strong>Purchase Management:</strong> Track purchases, costs, quantities, and suppliers.</li>
                                <li><strong>Sales Management:</strong> Sales processing, customer records, returns, and multiple payment methods.</li>
                                <li><strong>Expense Tracking:</strong> Log and monitor operational expenses.</li>
                                <li><strong>Reporting:</strong> Stock, sales, profit & loss, and audit reports.</li>
                                <li><strong>Audit Logging:</strong> Full system activity logging for accountability.</li>
                                <li><strong>POS System:</strong> Fast sales interface with barcode scanning support.</li>
                                <li><strong>License Management:</strong> Built-in license & trial enforcement system.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- ================= ABOUT TECHLINK360 ================= -->
                <div class="col-md-12">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">About TechLink360</h3>
                        </div>
                        <div class="card-body">
                            <p>
                                <strong>TechLink360</strong> is a technology-driven innovation hub focused on
                                building scalable, secure, and impact-oriented digital solutions tailored for
                                African businesses and institutions.
                            </p>

                            <p>
                                The organization specializes in solving real-world operational challenges by
                                integrating modern software engineering practices with emerging technologies.
                                Our solutions emphasize <strong>efficiency, sustainability, and growth</strong>.
                            </p>

                            <h5 class="mt-3">Core Focus Areas</h5>
                            <ul>
                                <li><strong>Business Systems:</strong> Inventory, POS, school & enterprise systems</li>
                                <li><strong>Sustainable Tech:</strong> SDG-aligned agriculture, health & education solutions</li>
                                <li><strong>Automation & IoT:</strong> Smart agriculture, sensors & monitoring</li>
                                <li><strong>Digital Transformation:</strong> SME process automation</li>
                                <li><strong>Research & Innovation:</strong> Prototyping & emerging technologies</li>
                            </ul>

                            <h5 class="mt-3">Vision</h5>
                            <p>
                                To empower businesses and communities through innovative,
                                accessible, and sustainable technology solutions.
                            </p>

                            <h5 class="mt-3">Mission</h5>
                            <p>
                                To design and deliver reliable digital systems that enhance productivity,
                                transparency, and data-driven decision-making.
                            </p>

                            <p class="mt-3">
                                This Inventory Management System (IMS) is a flagship TechLink360 product,
                                built for scalability, security, and ease of use.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- ================= CHANGELOG ================= -->
                <div class="col-md-12">
                    <div class="card card-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Changelog</h3>
                        </div>
                        <div class="card-body bg-dark text-white markdown-body">
                            {!! \Illuminate\Support\Str::markdown($changelogContent) !!}
                        </div>
                    </div>
                </div>

            </div>

           

        </div>
    </section>
</div>
