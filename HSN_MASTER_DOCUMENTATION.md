# HSN Master (Harmonized System of Nomenclature) - Complete Documentation

## Overview

The HSN Master system manages Harmonized System of Nomenclature (HSN) codes for goods and Service Accounting Codes (SAC) for services. This system is essential for accurate GST classification, tax rate application, and compliance with Indian customs and tax regulations.

**Status:** ✅ Production Ready  
**Created:** December 22, 2025  
**Version:** 1.0.0

---

## Table of Contents

1. [System Architecture](#system-architecture)
2. [Database Schema](#database-schema)
3. [Models & Relationships](#models--relationships)
4. [Controllers & Methods](#controllers--methods)
5. [Views & Forms](#views--forms)
6. [Validation Rules](#validation-rules)
7. [Routes & Endpoints](#routes--endpoints)
8. [Features & Functionality](#features--functionality)
9. [Usage Examples](#usage-examples)
10. [Installation & Setup](#installation--setup)
11. [Testing Scenarios](#testing-scenarios)
12. [Troubleshooting](#troubleshooting)
13. [Future Enhancements](#future-enhancements)

---

## System Architecture

### Technology Stack
- **Framework:** Laravel 11
- **Database:** MySQL
- **ORM:** Eloquent
- **Frontend:** Blade Templates + Bootstrap 5
- **Icons:** UIL (Unicons)

### Component Structure

```
HSN Master System
├── Database
│   └── Migration (2025_12_22_000002_create_hsn_masters_table.php)
├── Model
│   └── HsnMaster.php
├── Controller
│   └── HSNMasterController.php
├── Views
│   ├── hsnMaster.blade.php (List & Search)
│   └── hsn_form.blade.php (Create & Edit)
└── Routes
    └── web.php (Resource + Custom Routes)
```

---

## Database Schema

### Table: `hsn_masters`

```sql
CREATE TABLE hsn_masters (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    
    -- Basic Information
    hsn_code VARCHAR(8) UNIQUE NOT NULL,
    hsn_type ENUM('HSN', 'SAC') DEFAULT 'HSN',
    commodity_name VARCHAR(255) NOT NULL,
    description LONGTEXT,
    
    -- GST Tax Rates
    sgst_rate DECIMAL(5, 2) DEFAULT 0,
    cgst_rate DECIMAL(5, 2) DEFAULT 0,
    igst_rate DECIMAL(5, 2) DEFAULT 0,
    cess_rate DECIMAL(5, 2) DEFAULT 0,
    
    -- Computed Columns (Virtual)
    total_gst_rate DECIMAL(5, 2) GENERATED ALWAYS AS (sgst_rate + cgst_rate),
    total_tax_rate DECIMAL(5, 2) GENERATED ALWAYS AS (sgst_rate + cgst_rate + cess_rate),
    
    -- HSN Specific Details
    unit_of_measurement VARCHAR(20),
    standard_description VARCHAR(100),
    chapter_number VARCHAR(10),
    
    -- Additional Fields
    remarks LONGTEXT,
    is_active BOOLEAN DEFAULT true,
    is_exempted BOOLEAN DEFAULT false,
    is_nil_rated BOOLEAN DEFAULT false,
    
    -- Audit Fields
    created_by BIGINT UNSIGNED,
    updated_by BIGINT UNSIGNED,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP (Soft Delete),
    
    -- Indexes
    INDEX idx_hsn_code (hsn_code),
    INDEX idx_hsn_type (hsn_type),
    INDEX idx_is_active (is_active),
    INDEX idx_chapter_number (chapter_number),
    
    -- Foreign Keys
    FOREIGN KEY (created_by) REFERENCES users(id),
    FOREIGN KEY (updated_by) REFERENCES users(id)
);
```

### Field Descriptions

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| hsn_code | string(8) | ✓ | 6-8 digit HSN/SAC code (unique) |
| hsn_type | enum | ✓ | Type: HSN (Goods) or SAC (Services) |
| commodity_name | string(255) | ✓ | Name of commodity/service |
| description | text | ✗ | Detailed description |
| sgst_rate | decimal(5,2) | ✓ | State GST percentage (0-100) |
| cgst_rate | decimal(5,2) | ✓ | Central GST percentage (0-100) |
| igst_rate | decimal(5,2) | ✓ | Integrated GST percentage (0-100) |
| cess_rate | decimal(5,2) | ✗ | Cess percentage if applicable |
| unit_of_measurement | string(20) | ✗ | UOM: Pcs, Kg, Litre, Meter, etc |
| standard_description | string(100) | ✗ | HSN standard description |
| chapter_number | string(10) | ✗ | Chapter number (01-99) |
| remarks | text | ✗ | Additional notes |
| is_active | boolean | Default: true | Active/Inactive status |
| is_exempted | boolean | Default: false | GST exemption flag |
| is_nil_rated | boolean | Default: false | Nil-rated flag |

---

## Models & Relationships

### HsnMaster Model

**File:** `/app/Models/HsnMaster.php`

#### Fillable Properties
```php
protected $fillable = [
    'hsn_code',
    'hsn_type',
    'commodity_name',
    'description',
    'sgst_rate',
    'cgst_rate',
    'igst_rate',
    'cess_rate',
    'unit_of_measurement',
    'standard_description',
    'chapter_number',
    'remarks',
    'is_active',
    'is_exempted',
    'is_nil_rated',
    'created_by',
    'updated_by'
];
```

#### Casts
```php
protected $casts = [
    'sgst_rate' => 'decimal:2',
    'cgst_rate' => 'decimal:2',
    'igst_rate' => 'decimal:2',
    'cess_rate' => 'decimal:2',
    'is_active' => 'boolean',
    'is_exempted' => 'boolean',
    'is_nil_rated' => 'boolean',
];
```

#### Relationships

```php
// Get user who created this record
public function creator()
{
    return $this->belongsTo(User::class, 'created_by');
}

// Get user who last updated this record
public function updater()
{
    return $this->belongsTo(User::class, 'updated_by');
}
```

#### Scopes (Query Helpers)

```php
// Get only active HSN codes
HsnMaster::active()->get()

// Get HSN codes by type
HsnMaster::byType('HSN')->get()
HsnMaster::byType('SAC')->get()

// Get exempted HSN codes
HsnMaster::exempted()->get()

// Get nil-rated HSN codes
HsnMaster::nilRated()->get()

// Search by HSN code or commodity name
HsnMaster::search('1001')->get()
HsnMaster::search('cotton')->get()
```

#### Accessors (Computed Attributes)

```php
// Total GST (SGST + CGST)
$hsn->total_gst_rate  // Returns float

// Total Tax (SGST + CGST + Cess)
$hsn->total_tax_rate  // Returns float

// Formatted tax description
$hsn->formatted_tax   // Returns: "SGST: 9% | CGST: 9% | IGST: 18% | Cess: 0%"
```

#### Methods

```php
// Check if HSN is taxable
$hsn->isTaxable()  // Returns boolean

// Get tax rate by type
$hsn->getTaxRateByType('SGST')      // Returns 9
$hsn->getTaxRateByType('CGST')      // Returns 9
$hsn->getTaxRateByType('IGST')      // Returns 18
$hsn->getTaxRateByType('TOTAL_GST') // Returns 18
$hsn->getTaxRateByType('TOTAL_TAX') // Returns 18
```

---

## Controllers & Methods

### HSNMasterController

**File:** `/app/Http/Controllers/HSNMasterController.php`

#### Public Methods

##### 1. index(Request $request)
**Purpose:** Display list of all HSN Masters with search and filters

**Parameters:**
- `search` (optional): Search by HSN code or commodity name
- `hsn_type` (optional): Filter by HSN or SAC
- `status` (optional): Filter by active/inactive

**Returns:** View with paginated HSN Masters

**Example:**
```
GET /admin/hsnMaster
GET /admin/hsnMaster?search=1001&hsn_type=HSN&status=active
```

##### 2. create()
**Purpose:** Show form for creating new HSN Master

**Returns:** Create form view

**Example:**
```
GET /admin/hsnMaster/create
```

##### 3. store(Request $request)
**Purpose:** Save newly created HSN Master to database

**Validation:**
- hsn_code: required, unique, max 8 characters
- hsn_type: required, HSN or SAC
- commodity_name: required, string
- Tax rates: required, numeric, 0-100
- All other fields: optional

**Returns:** Redirect to index with success message

**Example:**
```
POST /admin/hsnMaster
{
    "hsn_code": "1001",
    "hsn_type": "HSN",
    "commodity_name": "Cotton Fabric",
    "sgst_rate": 9,
    "cgst_rate": 9,
    "igst_rate": 18
}
```

##### 4. edit(HsnMaster $hsnMaster)
**Purpose:** Show edit form for existing HSN Master

**Parameters:** HsnMaster ID (via route model binding)

**Returns:** Edit form view with pre-filled data

**Example:**
```
GET /admin/hsnMaster/5/edit
```

##### 5. update(Request $request, HsnMaster $hsnMaster)
**Purpose:** Update HSN Master in database

**Validation:** Same as store() with unique check excluding current record

**Returns:** Redirect to index with success message

**Example:**
```
PATCH /admin/hsnMaster/5
{
    "commodity_name": "Cotton Fabric (Updated)",
    "sgst_rate": 12
}
```

##### 6. destroy(HsnMaster $hsnMaster)
**Purpose:** Soft delete HSN Master

**Returns:** Redirect to index with success message

**Example:**
```
DELETE /admin/hsnMaster/5
```

#### AJAX Methods

##### 7. getByCode($code)
**Purpose:** Get HSN Master details by code via AJAX

**Returns:** JSON response with HSN details

**Example:**
```
GET /admin/hsnMaster/getByCode/1001

Response:
{
    "success": true,
    "data": {
        "id": 1,
        "hsn_code": "1001",
        "commodity_name": "Cotton Fabric",
        "sgst_rate": 9,
        "cgst_rate": 9,
        "igst_rate": 18,
        "total_tax_rate": 36,
        "is_exempted": false
    }
}
```

##### 8. getByType($type)
**Purpose:** Get all active HSN Masters by type via AJAX

**Parameters:** type (HSN or SAC)

**Returns:** JSON array of HSN codes

**Example:**
```
GET /admin/hsnMaster/getByType/HSN

Response:
{
    "success": true,
    "data": [
        {
            "id": 1,
            "hsn_code": "1001",
            "commodity_name": "Cotton Fabric",
            "formatted_tax": "SGST: 9% | CGST: 9% | IGST: 18%"
        }
    ]
}
```

##### 9. calculateTax(Request $request)
**Purpose:** Calculate tax amount for given HSN and amount via AJAX

**Parameters:**
- hsn_id: HSN Master ID
- amount: Base amount
- tax_type: SGST, CGST, IGST, or TOTAL_GST (default)

**Returns:** JSON with calculated tax

**Example:**
```
POST /admin/hsnMaster/calculateTax
{
    "hsn_id": 1,
    "amount": 1000,
    "tax_type": "TOTAL_GST"
}

Response:
{
    "success": true,
    "amount": 1000,
    "tax_rate": 18,
    "tax_amount": 180,
    "total_amount": 1180
}
```

---

## Views & Forms

### 1. hsnMaster.blade.php (List View)

**File:** `/resources/views/admin/hsnMaster.blade.php`

**Features:**
- Search box for HSN code/commodity name
- Filter by HSN Type (HSN/SAC)
- Filter by Status (Active/Inactive)
- Paginated list (50 records per page)
- Responsive table with action buttons
- Empty state message

**Sections:**
```
┌─────────────────────────────────────┐
│ Page Header with Icon               │
├─────────────────────────────────────┤
│ Search & Filter Form                │
├─────────────────────────────────────┤
│ "Add New HSN Master" Button          │
├─────────────────────────────────────┤
│ HSN Masters List Table              │
│ ├─ S.N. | HSN Code | Type | Name    │
│ ├─ Tax Rates | UOM | Status | Actions│
│ └─ Pagination Controls              │
└─────────────────────────────────────┘
```

### 2. hsn_form.blade.php (Create/Edit Form)

**File:** `/resources/views/admin/hsn_form.blade.php`

**Features:**
- 4-tab form interface
- Icon labels for each field
- Real-time validation feedback
- Responsive layout
- Tab navigation

**Tabs:**

**Tab 1: Basic Information**
- HSN Code (required, 6-8 digits)
- HSN Type (required, dropdown)
- Commodity Name (required)
- Description (optional, textarea)
- Active Status toggle

**Tab 2: Tax Information**
- SGST Rate (required, 0-100)
- CGST Rate (required, 0-100)
- IGST Rate (required, 0-100)
- Cess Rate (optional, 0-100)
- Is GST Exempted checkbox
- Is Nil Rated checkbox

**Tab 3: Additional Details**
- Unit of Measurement (optional)
- Chapter Number (optional)
- Standard Description (optional)

**Tab 4: Remarks**
- Remarks textarea (optional, 5 rows)

---

## Validation Rules

### Store Validation

```php
[
    'hsn_code' => 'required|string|max:8|unique:hsn_masters,hsn_code',
    'hsn_type' => 'required|in:HSN,SAC',
    'commodity_name' => 'required|string|max:255',
    'description' => 'nullable|string',
    'sgst_rate' => 'required|numeric|min:0|max:100',
    'cgst_rate' => 'required|numeric|min:0|max:100',
    'igst_rate' => 'required|numeric|min:0|max:100',
    'cess_rate' => 'nullable|numeric|min:0|max:100',
    'unit_of_measurement' => 'nullable|string|max:20',
    'standard_description' => 'nullable|string|max:100',
    'chapter_number' => 'nullable|string|max:10',
    'remarks' => 'nullable|string',
    'is_active' => 'nullable|boolean',
    'is_exempted' => 'nullable|boolean',
    'is_nil_rated' => 'nullable|boolean',
]
```

### Update Validation

Same as store, except:
```php
'hsn_code' => 'required|string|max:8|unique:hsn_masters,hsn_code,' . $hsnMaster->id,
```

---

## Routes & Endpoints

### Resource Routes

All routes automatically generated by Laravel resource routing:

```php
Route::resource('/admin/hsnMaster', HSNMasterController::class);
```

| Method | URI | Action | Purpose |
|--------|-----|--------|---------|
| GET | `/admin/hsnMaster` | index | List all HSN Masters |
| GET | `/admin/hsnMaster/create` | create | Show create form |
| POST | `/admin/hsnMaster` | store | Save new HSN Master |
| GET | `/admin/hsnMaster/{id}` | show | *(Not used)* |
| GET | `/admin/hsnMaster/{id}/edit` | edit | Show edit form |
| PUT/PATCH | `/admin/hsnMaster/{id}` | update | Update HSN Master |
| DELETE | `/admin/hsnMaster/{id}` | destroy | Delete HSN Master |

### Custom Routes

```php
# Get HSN Master by code
GET /admin/hsnMaster/getByCode/{code}

# Get all HSN Masters by type
GET /admin/hsnMaster/getByType/{type}

# Calculate tax for amount
POST /admin/hsnMaster/calculateTax
```

---

## Features & Functionality

### 1. Create HSN Master
- Fill basic information (code, type, commodity)
- Set tax rates (SGST, CGST, IGST, Cess)
- Mark as exempted or nil-rated if applicable
- Optional UOM and chapter number
- Save with created_by audit field

### 2. Read HSN Master
- View all HSN Masters with pagination
- Search by HSN code or commodity name
- Filter by type (HSN/SAC)
- Filter by status (Active/Inactive)
- View formatted tax rates

### 3. Update HSN Master
- Edit all fields except HSN code (can be edited if needed)
- Update tax rates
- Change status
- Add/update remarks
- Tracked with updated_by audit field

### 4. Delete HSN Master
- Soft delete (not permanently removed)
- Can be restored if needed
- Prevents orphaned references

### 5. Search & Filter
- Real-time search across HSN code and commodity name
- Filter by type (HSN/SAC)
- Filter by status
- Pagination with 50 records per page

### 6. AJAX Lookups
- Get HSN details by code
- Get all HSN codes by type
- Calculate tax amounts dynamically

---

## Usage Examples

### Example 1: Create New HSN Master

```php
// Using HTTP request
POST /admin/hsnMaster
{
    "hsn_code": "1001",
    "hsn_type": "HSN",
    "commodity_name": "Cotton Fabric",
    "description": "Cotton fabric for clothing",
    "sgst_rate": 9,
    "cgst_rate": 9,
    "igst_rate": 18,
    "unit_of_measurement": "Meter",
    "chapter_number": "52",
    "is_active": true
}
```

### Example 2: Search HSN Masters

```php
// Search by HSN code
GET /admin/hsnMaster?search=1001

// Search by commodity name
GET /admin/hsnMaster?search=cotton

// Filter by type
GET /admin/hsnMaster?hsn_type=HSN

// Combined filters
GET /admin/hsnMaster?search=1001&hsn_type=HSN&status=active
```

### Example 3: Using in Other Forms (AJAX)

```javascript
// Get HSN details for selection
fetch('/admin/hsnMaster/getByCode/1001')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('HSN Code:', data.data.hsn_code);
            console.log('Tax Rate:', data.data.total_tax_rate);
        }
    });

// Get all HSN codes of type HSN
fetch('/admin/hsnMaster/getByType/HSN')
    .then(response => response.json())
    .then(data => {
        data.data.forEach(hsn => {
            console.log(`${hsn.hsn_code} - ${hsn.commodity_name}`);
        });
    });

// Calculate tax
fetch('/admin/hsnMaster/calculateTax', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
        hsn_id: 1,
        amount: 1000,
        tax_type: 'TOTAL_GST'
    })
})
.then(response => response.json())
.then(data => {
    console.log('Tax Amount:', data.tax_amount);
    console.log('Total Amount:', data.total_amount);
});
```

### Example 4: In Controller

```php
use App\Models\HsnMaster;

// Get all active HSN codes
$activeHsns = HsnMaster::active()->get();

// Get all HSN codes by type
$goodsHsns = HsnMaster::byType('HSN')->get();
$serviceHsns = HsnMaster::byType('SAC')->get();

// Search HSN
$results = HsnMaster::search('cotton')->get();

// Get HSN and check taxability
$hsn = HsnMaster::find(1);
if ($hsn->isTaxable()) {
    $sgst = $hsn->getTaxRateByType('SGST');
}

// Calculate tax in code
$amount = 1000;
$taxRate = $hsn->getTaxRateByType('TOTAL_GST') / 100;
$taxAmount = $amount * $taxRate;
$total = $amount + $taxAmount;
```

---

## Installation & Setup

### Step 1: Run Migration

```bash
php artisan migrate
```

This creates the `hsn_masters` table with all fields and indexes.

### Step 2: Access HSN Master

Navigate to: **Master Menu → HSN Master** in navbar  
Or direct URL: `http://localhost/bharatonline/admin/hsnMaster`

### Step 3: Create Test Data

1. Click "Add New HSN Master" button
2. Fill basic information:
   - HSN Code: `1001`
   - Type: `HSN`
   - Commodity: `Cotton Fabric`
   - SGST: `9`
   - CGST: `9`
   - IGST: `18`
3. Click "Create HSN Master"

### Step 4: Verify Installation

- List view should show your created record
- Search should filter by code/commodity
- Edit and delete buttons should work
- Status toggle should function

---

## Testing Scenarios

### Test 1: Create HSN Master
**Steps:**
1. Click "Add New HSN Master"
2. Fill all required fields
3. Click "Create HSN Master"

**Expected:** Record appears in list with success message

### Test 2: Search Functionality
**Steps:**
1. Create multiple HSN codes
2. Type in search box
3. Submit

**Expected:** List filters to matching records

### Test 3: Edit HSN Master
**Steps:**
1. Click Edit button
2. Change commodity name
3. Update tax rate
4. Click "Update HSN Master"

**Expected:** Changes saved, list updated

### Test 4: Delete HSN Master
**Steps:**
1. Click Delete button
2. Confirm dialog

**Expected:** Record removed from list

### Test 5: Filter by Type
**Steps:**
1. Create HSN (goods) and SAC (services)
2. Select "HSN (Goods)" in type filter
3. Submit

**Expected:** Only HSN records shown

### Test 6: Tax Calculation
**Steps:**
1. Create HSN with 18% GST
2. Use calculateTax AJAX endpoint
3. Pass amount 1000

**Expected:** Tax = 180, Total = 1180

### Test 7: Soft Delete Recovery
**Steps:**
1. Delete HSN record
2. Check database: `SELECT * FROM hsn_masters WHERE deleted_at IS NOT NULL;`

**Expected:** Record still exists with deleted_at timestamp

---

## Troubleshooting

### Issue 1: Migration Error
**Error:** "Table already exists"
**Solution:**
```bash
php artisan migrate:refresh --path=database/migrations/2025_12_22_000002_create_hsn_masters_table.php
```

### Issue 2: Model Not Found
**Error:** "Class 'App\Models\HsnMaster' not found"
**Solution:**
```bash
composer dump-autoload
```

### Issue 3: Route Not Found
**Error:** "Route [hsnMaster.index] not defined"
**Solution:**
```bash
php artisan route:clear
php artisan route:cache
```

### Issue 4: Validation Fails on Unique Code
**Error:** "HSN Code already exists"
**Solution:**
- Use different HSN code
- Or soft-delete existing record and use code

### Issue 5: AJAX Endpoints Return 404
**Error:** "Route not found for /admin/hsnMaster/getByCode/1001"
**Solution:**
- Ensure routes are registered correctly
- Check route order in web.php
- Verify HSNMasterController exists

---

## Future Enhancements

### 1. Bulk Import/Export
- Excel import for multiple HSN codes
- CSV export for backup
- Validate format before import

### 2. HSN History Tracking
- Track tax rate changes over time
- Maintain historical versions
- Audit trail for compliance

### 3. GST Slab Management
- Define applicable GST slabs
- Link HSN to GST slab
- Automatic calculation

### 4. Integration with Transactions
- Auto-populate HSN in invoices
- Prevent using inactive HSN codes
- Validate HSN for transaction type

### 5. Reporting & Analytics
- HSN-wise tax collection reports
- Commodity classification analysis
- Type-wise distribution reports

### 6. API Endpoints
- REST API for external systems
- Mobile app integration
- Third-party ERP sync

### 7. Multi-Language Support
- HSN descriptions in multiple languages
- Commodity names in regional languages
- Localization for different states

### 8. Advanced Validation
- HSN code format validation
- Duplicate detection across related tables
- Tax rate range validation

---

## Summary

The HSN Master system provides a complete, production-ready solution for managing HSN/SAC codes with:

✅ Full CRUD operations  
✅ Search and filter functionality  
✅ Tax calculation utilities  
✅ Soft delete support  
✅ Audit trail (created_by, updated_by)  
✅ Responsive UI  
✅ AJAX integration points  
✅ Comprehensive validation  
✅ RESTful API design  

**Ready for production deployment!**

---

## Support & Maintenance

For issues, enhancements, or questions:
1. Check this documentation
2. Review model and controller code
3. Check database schema
4. Run tests in Testing Scenarios section
5. Monitor created_by/updated_by audit fields

**Version:** 1.0.0  
**Last Updated:** December 22, 2025  
**Status:** ✅ Production Ready
