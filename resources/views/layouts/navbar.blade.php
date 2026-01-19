<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('trips.indexAll', 1) }}">
            <!-- <img src="{{ asset('dashboard/assets/images/logo-dark.png') }}" alt="Logo" height="24"> -->
            <span class="ms-2 d-none d-sm-inline">TruckBook</span>
        </a>

        <!-- Hamburger Menu Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->route()->getName() === 'trips.indexAll' ? 'active' : '' }}" 
                       href="{{ route('admin.dashboard') }}">
                        <i class="uil-home-alt me-1"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Master Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->segment(3) === 'session' || request()->segment(3) === 'party' || request()->segment(3) === 'supplier' || request()->segment(3) === 'driver' || request()->segment(3) === 'vehicleType' || request()->segment(3) === 'billType' || request()->segment(3) === 'vehicle' || request()->segment(3) === 'state' || request()->segment(3) === 'route' || request()->segment(3) === 'bank' || request()->segment(3) === 'unit' || request()->segment(3) === 'category' || request()->segment(3) === 'hsnMaster' || request()->segment(3) === 'ledgerMaster' ? 'active' : '' }}" 
                       href="#" id="masterDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="uil-store me-1"></i>
                        <span>Master</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="masterDropdown">
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'category.index' ? 'active' : '' }}" 
                               href="{{ route('category.index') }}">
                                <i class="uil-tag me-2"></i>Add Category
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'unit.index' ? 'active' : '' }}" 
                               href="{{ route('unit.index') }}">
                                <i class="uil-box me-2"></i>Add Unit
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'session.create' ? 'active' : '' }}" 
                               href="{{ route('session.create') }}">
                                <i class="uil-calendar me-2"></i>Add Session
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'accountGroup.index' ? 'active' : '' }}" 
                               href="{{ route('accountGroup.index') }}">
                                <i class="uil-calendar me-2"></i>Group Account
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'party.index' ? 'active' : '' }}" 
                               href="{{ route('party.index') }}">
                                <i class="uil-calendar me-2"></i>Add Consignor
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'supplier.index' ? 'active' : '' }}" 
                               href="{{ route('supplier.index') }}">
                                <i class="uil-calendar me-2"></i>Add Supplier
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'driver.index' ? 'active' : '' }}" 
                               href="{{ route('driver.index') }}">
                                <i class="uil-calendar me-2"></i>Add Drivers
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'vehicleType.index' ? 'active' : '' }}" 
                               href="{{ route('vehicleType.index') }}">
                                <i class="uil-calendar me-2"></i>Add Vehicle Type
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'billType.index' ? 'active' : '' }}" 
                               href="{{ route('billType.index') }}">
                                <i class="uil-calendar me-2"></i>Add Bill Type
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'bank.index' ? 'active' : '' }}" 
                               href="{{ route('bank.index') }}">
                                <i class="uil-building me-2"></i>Add Bank
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'ledgerMaster.index' ? 'active' : '' }}" 
                               href="{{ route('ledgerMaster.index') }}">
                                <i class="uil-book-open me-2"></i>Ledger Master
                            </a>
                        </li>
                        
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'vehicle.index' ? 'active' : '' }}" 
                               href="{{ route('vehicle.index') }}">
                                <i class="uil-calendar me-2"></i>Add Vehicle
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'state.index' ? 'active' : '' }}" 
                               href="{{ route('state.index') }}">
                                <i class="uil-calendar me-2"></i>Add State
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'route.index' ? 'active' : '' }}" 
                               href="{{ route('route.index') }}">
                                <i class="uil-calendar me-2"></i>Add Route
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'phoneDirectory.index' ? 'active' : '' }}" 
                               href="{{ route('phoneDirectory.index') }}">
                                <i class="uil-calendar me-2"></i>Add Phone Directory
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'hsnMaster.index' ? 'active' : '' }}" 
                               href="{{ route('hsnMaster.index') }}">
                                <i class="uil-barcode-read me-2"></i>HSN Master
                            </a>
                        </li>

                        <li>
                                        <a class="dropdown-item {{ request()->route()->getName() === 'voucherEntryType.index' ? 'active' : '' }}"
                                             href="{{ route('voucherEntryType.index') }}">
                                        <i class="uil-calender"></i>
                                         <span>Add Voucher Entry Type</span>
                                         </a>
                                    </li>
                    </ul>
                </li>

                <!-- Trips -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->route()->getName() === 'trips.indexAll' && request()->route()->parameter(1) == 1 ? 'active' : '' }}" 
                       href="{{ route('trips.indexAll', 1) }}">
                        <i class="uil-calendar me-1"></i>
                        <span>Trips</span>
                    </a>
                </li>

                <!-- Trips Complete List -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->route()->getName() === 'trips.indexAll' && request()->route()->parameter(1) == 5 ? 'active' : '' }}" 
                       href="{{ route('trips.indexAll', 5) }}">
                        <i class="uil-calendar me-1"></i>
                        <span>Complete List</span>
                    </a>
                </li>

                <!-- Reports Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->route()->getName() === 'supplierReport' || request()->route()->getName() === 'partyReport' || request()->route()->getName() === 'supplierledgerReport' || request()->route()->getName() === 'partyLedgerReport' ? 'active' : '' }}" 
                       href="#" id="reportsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="uil-calendar me-1"></i>
                        <span>Reports</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="reportsDropdown">
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'supplierReport' ? 'active' : '' }}" 
                               href="{{ route('supplierReport') }}">
                                <i class="uil-calendar me-2"></i>Supplier Balance Reports
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'partyReport' ? 'active' : '' }}" 
                               href="{{ route('partyReport') }}">
                                <i class="uil-calendar me-2"></i>Party Balance Reports
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'supplierledgerReport' ? 'active' : '' }}" 
                               href="{{ route('supplierledgerReport') }}">
                                <i class="uil-calendar me-2"></i>Supplier Reports
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->route()->getName() === 'partyLedgerReport' ? 'active' : '' }}" 
                               href="{{ route('partyLedgerReport') }}">
                                <i class="uil-calendar me-2"></i>Party Reports
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Company Ledger -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->route()->getName() === 'companyLedger' ? 'active' : '' }}" 
                       href="{{ route('companyLedger') }}">
                        <i class="uil-calendar me-1"></i>
                        <span>Company Ledger</span>
                    </a>
                </li>

                <!-- Transactions -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->route()->getName() === 'trans.create' ? 'active' : '' }}" 
                       href="{{ route('trans.create') }}">
                        <i class="uil-calendar me-1"></i>
                        <span>Transactions</span>
                    </a>
                </li>

                <!-- User Dropdown (on the right) -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="uil-user me-1"></i>
                        <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <span class="dropdown-item-text">{{ Auth::user()->email }}</span>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                <i class="uil-logout me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
