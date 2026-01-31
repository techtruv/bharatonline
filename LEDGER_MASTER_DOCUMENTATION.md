# 📚 Ledger Master - Complete Documentation

**Created:** December 22, 2025  
**Status:** ✅ Production Ready  
**Framework:** Laravel 11 + Bootstrap 5  

---

## 📋 Overview

Comprehensive Ledger Master system for managing all types of financial accounts/ledgers with multiple information tabs.

**Features:**
✅ **6 Ledger Types** - General, Party, Vehicle, Consignee, Consignor, Self Vehicle  
✅ **Multiple Tabs** - Basic Info, Corporate, Address, Personal, GST  
✅ **Financial Fields** - Opening balance, DR/CR, Balance type  
✅ **GST Verification** - Built-in GST validation and verification  
✅ **Full CRUD** - Create, Read, Update, Delete operations  
✅ **Search & Filter** - Find ledgers quickly  
✅ **Responsive Design** - Works on all devices  

---

## 🗄️ Database Schema

### Ledger Masters Table

**Table:** `ledger_masters`

```sql
CREATE TABLE ledger_masters (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    
    -- Basic Information
    type ENUM('General','Party','Vehicle','Consignee','Consignor','Self Vehicle') NOT NULL,
    name VARCHAR(255) NOT NULL UNIQUE INDEX,
    short_name VARCHAR(50),
    under_group_id BIGINT,
    
    -- Financial Information
    opening_balance DECIMAL(15,2) DEFAULT 0,
    dr_cr ENUM('DR','CR') DEFAULT 'DR',
    balance_type ENUM('Debit','Credit') DEFAULT 'Debit',
    
    -- Status
    status ENUM('Active','Inactive') DEFAULT 'Active' INDEX,
    
    -- Corporate Details
    company_name VARCHAR(255),
    company_pan VARCHAR(20),
    company_cin VARCHAR(50),
    company_gstin VARCHAR(20),
    
    -- Address
    address_line_1 TEXT,
    address_line_2 TEXT,
    city VARCHAR(100),
    state VARCHAR(100),
    pincode VARCHAR(10),
    country VARCHAR(100),
    
    -- Personal Details
    contact_person_name VARCHAR(255),
    email VARCHAR(255),
    mobile VARCHAR(15),
    telephone VARCHAR(15),
    fax VARCHAR(15),
    contact_person_designation VARCHAR(100),
    
    -- GST Verification
    gst_number VARCHAR(20),
    gst_registration_type ENUM('Regular','Composition','Unregistered'),
    gst_registration_date DATE,
    gst_details TEXT,
    is_gst_verified BOOLEAN DEFAULT FALSE,
    
    -- Additional
    remarks TEXT,
    created_by BIGINT,
    updated_by BIGINT,
    
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP,
    
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);
```

---

## 🏗️ Project Structure

```
bharatonline/
├── app/Models/
│   └── LedgerMaster.php              # Model with relationships
├── app/Http/Controllers/
│   └── LedgerMasterController.php    # CRUD operations
├── database/migrations/
│   └── 2025_12_22_000001_create_ledger_masters_table.php
├── resources/views/admin/
│   ├── ledgerMaster.blade.php        # Main view (list/edit)
│   └── ledger_form.blade.php         # Form component with tabs
└── routes/
    └── web.php                       # Routes registration
```

---

## 📝 Ledger Types

| Type | Description | Usage |
|------|-------------|-------|
| **General** | General ledger accounts | Assets, Liabilities, Expenses |
| **Party** | Party/Customer accounts | Receivables and payables |
| **Vehicle** | Vehicle accounts | Vehicle expenses and income |
| **Consignee** | Consignee accounts | Goods consigned to customers |
| **Consignor** | Consignor accounts | Goods received from suppliers |
| **Self Vehicle** | Company's own vehicle accounts | Transport and logistics |

---

## 📑 Form Tabs

### 1. Basic Information Tab
- **Type** (required) - Select ledger type
- **Ledger Name** (required) - Unique name for ledger
- **Short Name** - Abbreviated name (max 50 chars)
- **Under Group** - Belongs to account group
- **Opening Balance** - Initial balance amount
- **DR/CR** - Debit or Credit side
- **Balance Type** - Debit or Credit balance
- **Status** - Active or Inactive
- **Remarks** - Additional notes

### 2. Corporate Details Tab
- **Company Name** - Official company name
- **PAN** - Permanent Account Number (max 20 chars)
- **CIN** - Company Identification Number
- **GSTIN** - Corporate GST Identification Number

### 3. Address Tab
- **Address Line 1** - Street address
- **Address Line 2** - Apartment/Suite details
- **City** - City name
- **State** - State name
- **Pincode** - Postal code (max 10 chars)
- **Country** - Country name (default: India)

### 4. Personal Details Tab
- **Contact Person Name** - Primary contact name
- **Email** - Contact email address
- **Mobile** - Mobile number (max 15 digits)
- **Telephone** - Landline number (max 15 digits)
- **Fax** - Fax number (max 15 digits)
- **Designation** - Job title/designation

### 5. GST Verification Tab
- **GST Number** - 15-character GST number
- **Registration Type** - Regular, Composition, or Unregistered
- **Registration Date** - GST registration date
- **GST Details** - Additional GST information
- **GST Verified** - Checkbox to mark as verified
- **Verify Button** - Client-side GST format validation

---

## 🔧 Model: LedgerMaster

**File:** `/app/Models/LedgerMaster.php`

### Properties

```php
protected $fillable = [
    'type', 'name', 'short_name', 'under_group_id',
    'opening_balance', 'dr_cr', 'balance_type', 'status',
    'company_name', 'company_pan', 'company_cin', 'company_gstin',
    'address_line_1', 'address_line_2', 'city', 'state', 'pincode', 'country',
    'contact_person_name', 'email', 'mobile', 'telephone', 'fax', 'contact_person_designation',
    'gst_number', 'gst_registration_type', 'gst_registration_date', 'gst_details', 'is_gst_verified',
    'remarks', 'created_by', 'updated_by'
];
```

### Relationships

```php
// Get the account group
public function group()
{
    return $this->belongsTo(AccountGroup::class, 'under_group_id', 'id');
}

// Get creator user
public function creator()
{
    return $this->belongsTo(User::class, 'created_by', 'id');
}

// Get updater user
public function updater()
{
    return $this->belongsTo(User::class, 'updated_by', 'id');
}
```

### Scopes

```php
// Get only active ledgers
LedgerMaster::active()->get();

// Get ledgers by type
LedgerMaster::byType('Party')->get();
```

### Accessors

```php
// Get full address as string
$ledger->full_address;

// Get formatted balance with currency
$ledger->formatted_opening_balance; // Returns: "₹ 10,000.00"

// Check if GST registered
$ledger->isGstRegistered(); // Returns: true/false
```

---

## 🎮 Controller: LedgerMasterController

### Methods

#### 1. index()
```php
public function index()
{
    // Get all ledgers with relationships
    $records = LedgerMaster::with(['group', 'creator', 'updater'])
        ->orderBy('created_at', 'DESC')
        ->get();
    
    // Get active groups and types for dropdowns
    $groups = AccountGroup::where('status', 'Active')->get();
    $types = ['General', 'Party', 'Vehicle', 'Consignee', 'Consignor', 'Self Vehicle'];
    
    return view('admin.ledgerMaster', compact('records', 'groups', 'types'));
}
```

#### 2. create()
Shows form for creating new ledger

#### 3. store()
Validates and stores new ledger in database
- Validates all input fields
- Sets created_by and updated_by
- Redirects to index with success message

#### 4. edit()
Shows form for editing existing ledger

#### 5. update()
Updates ledger record
- Validates all fields
- Allows unique name within current record
- Updates updated_by timestamp

#### 6. destroy()
Soft deletes ledger record

#### 7. getByType($type)
AJAX endpoint to get ledgers by type
```php
// Usage: /admin/ledgerMaster/get-by-type/Party
// Returns: JSON array of ledgers
```

#### 8. verifyGst()
AJAX endpoint to verify GST format
```php
// Validates GST number format (15-character pattern)
// Returns: JSON with status and message
```

---

## 🎨 Views

### ledgerMaster.blade.php
Main view file showing:
- Header with icon and description
- Alert messages (errors, success)
- List table of all ledgers (if not editing)
- Search functionality
- Action buttons (Edit, Delete)
- Add new ledger button

### ledger_form.blade.php
Form component with 5 tabs:
1. **Basic Information** - Core ledger details
2. **Corporate Details** - Company information
3. **Address** - Location details
4. **Personal Details** - Contact information
5. **GST Verification** - GST details and verification

---

## 📋 Validation Rules

```php
'type' => 'required|in:General,Party,Vehicle,Consignee,Consignor,Self Vehicle',
'name' => 'required|string|max:255|unique:ledger_masters,name',
'short_name' => 'nullable|string|max:50',
'under_group_id' => 'nullable|exists:account_groups,id',
'opening_balance' => 'nullable|numeric|min:0',
'dr_cr' => 'required|in:DR,CR',
'balance_type' => 'required|in:Debit,Credit',
'status' => 'required|in:Active,Inactive',

// Corporate Details
'company_name' => 'nullable|string|max:255',
'company_pan' => 'nullable|string|max:20',
'company_cin' => 'nullable|string|max:50',
'company_gstin' => 'nullable|string|max:20',

// Address
'address_line_1' => 'nullable|string',
'address_line_2' => 'nullable|string',
'city' => 'nullable|string|max:100',
'state' => 'nullable|string|max:100',
'pincode' => 'nullable|string|max:10',
'country' => 'nullable|string|max:100',

// Personal Details
'contact_person_name' => 'nullable|string|max:255',
'email' => 'nullable|email|max:255',
'mobile' => 'nullable|string|max:15',
'telephone' => 'nullable|string|max:15',
'fax' => 'nullable|string|max:15',
'contact_person_designation' => 'nullable|string|max:100',

// GST
'gst_number' => 'nullable|string|max:20',
'gst_registration_type' => 'nullable|in:Regular,Composition,Unregistered',
'gst_registration_date' => 'nullable|date',
'gst_details' => 'nullable|string',

'remarks' => 'nullable|string',
```

---

## 🚀 Routes

### Resource Routes
```php
// List all ledgers
GET  /admin/ledgerMaster              → index()

// Show create form
GET  /admin/ledgerMaster/create       → create()

// Store new ledger
POST /admin/ledgerMaster              → store()

// Show edit form
GET  /admin/ledgerMaster/{id}/edit    → edit()

// Update ledger
PUT  /admin/ledgerMaster/{id}         → update()

// Delete ledger
DELETE /admin/ledgerMaster/{id}       → destroy()
```

### Custom Routes
```php
// Verify GST number format
POST /admin/ledgerMaster/verify-gst   → verifyGst()

// Get ledgers by type (AJAX)
GET  /admin/ledgerMaster/get-by-type/{type} → getByType()
```

---

## 🎯 Features

### List View Features
✅ **Sortable Table** - Click columns to sort  
✅ **Search Functionality** - Real-time search by name/type  
✅ **Badges** - Color-coded type and status  
✅ **Balance Display** - Shows DR/CR with amount  
✅ **Action Buttons** - Edit and Delete options  

### Form Features
✅ **Tabbed Interface** - Organize information  
✅ **Icon Labels** - Visual identification  
✅ **Validation** - Client and server-side  
✅ **Error Display** - Clear validation messages  
✅ **GST Verification** - Real-time format checking  
✅ **Required Fields** - Marked with asterisks  
✅ **Responsive** - Works on all devices  

### Database Features
✅ **Soft Deletes** - Safe deletion  
✅ **Timestamps** - Track creation/updates  
✅ **Relationships** - Links to groups and users  
✅ **Indexes** - Fast searching  
✅ **Foreign Keys** - Data integrity  

---

## 🔐 Security

✅ **CSRF Protection** - @csrf tokens in forms  
✅ **Authorization** - Requires authentication  
✅ **Input Validation** - All fields validated  
✅ **SQL Injection Prevention** - Parameterized queries  
✅ **XSS Protection** - Output escaping  
✅ **Audit Trail** - created_by & updated_by tracking  

---

## 📊 Usage Examples

### Create Ledger
```php
$ledger = LedgerMaster::create([
    'type' => 'Party',
    'name' => 'ABC Trading Company',
    'short_name' => 'ABC',
    'opening_balance' => 10000,
    'dr_cr' => 'DR',
    'balance_type' => 'Debit',
    'status' => 'Active',
    'gst_number' => '27AAPCA5055K1ZO',
    'created_by' => auth()->user()->id,
]);
```

### Get Ledgers by Type
```php
$partyLedgers = LedgerMaster::byType('Party')->active()->get();
```

### Get Active Ledgers
```php
$activeLedgers = LedgerMaster::active()->get();
```

### Search Ledgers
```php
$ledgers = LedgerMaster::where('name', 'like', '%'.$searchTerm.'%')->get();
```

### Get Full Address
```php
$address = $ledger->full_address;
// Returns: "123 Main St, Suite 100, New York, NY, 10001, USA"
```

---

## 🧪 Testing

### Test Case 1: Create General Ledger
1. Click "Add New Ledger"
2. Select Type: General
3. Enter Name: "Salaries Payable"
4. Set Opening Balance: 0
5. Set Status: Active
6. Click Save
✓ Ledger created successfully

### Test Case 2: Create Party Ledger with GST
1. Create ledger of type "Party"
2. Fill Basic Information tab
3. Go to Corporate Details tab
4. Enter Company Name, PAN, GSTIN
5. Go to GST Verification tab
6. Enter GST Number
7. Click "Verify GST"
8. Check GST Verified checkbox
9. Save
✓ Party ledger with GST created

### Test Case 3: Edit Ledger
1. Click Edit on any ledger
2. Modify information in tabs
3. Click "Update Ledger"
✓ Ledger updated successfully

### Test Case 4: Search Ledgers
1. In list view, type in search box
2. Type ledger name or type
✓ Table filters in real-time

### Test Case 5: Delete Ledger
1. Click Delete button
2. Confirm in dialog
✓ Ledger deleted (soft delete)

---

## 🔧 Installation Steps

### 1. Create Migration
```bash
php artisan migrate
```

### 2. Register Route
Routes already registered in `/routes/web.php`

### 3. Access Application
Visit: `http://localhost/bharatonline/admin/ledgerMaster`

### 4. Create First Ledger
Click "Add New Ledger" and fill in required fields

---

## 📱 Responsive Design

✅ **Desktop** (1200px+) - Full tab interface  
✅ **Tablet** (768px-1200px) - Adjusted layout  
✅ **Mobile** (480px) - Stacked form fields  
✅ **Small Mobile** (360px) - Optimized for touch  

---

## 🎨 UI Components

### Tabs
- Smooth tab switching
- Active tab highlighted
- Icon indicators
- Responsive on mobile

### Forms
- Bootstrap 5 styling
- Icon labels
- Inline validation
- Error messages
- Helpful placeholders

### Tables
- Hover effects
- Color-coded badges
- Responsive overflow
- Search functionality
- Action buttons

### Buttons
- Primary, Secondary colors
- Icon integration
- Proper sizing
- Hover effects

---

## 🔄 Workflow

```
1. LOGIN
   ↓
2. NAVIGATE TO MASTER → LEDGER MASTER
   ↓
3. VIEW LIST OF LEDGERS
   ↓
4. CHOOSE ACTION:
   a) CREATE NEW → Fill Form → Save
   b) EDIT EXISTING → Modify → Update
   c) DELETE → Confirm → Remove
   d) SEARCH → Type name/type → Filter
   ↓
5. SUCCESS MESSAGE
   ↓
6. BACK TO LIST
```

---

## 📈 Future Enhancements

1. **Bulk Import** - Import ledgers from Excel
2. **Bulk Export** - Export ledgers to Excel/PDF
3. **Ledger Balances** - Calculate running balances
4. **Transaction History** - View ledger transactions
5. **GST API Integration** - Real-time GST verification
6. **Duplicate Detection** - Alert on similar names
7. **Batch Operations** - Bulk status changes
8. **Custom Reports** - Ledger-wise reports
9. **Approval Workflow** - Multi-level approval
10. **Audit Log** - Complete activity tracking

---

## ✅ Status

**Version:** 1.0  
**Status:** ✅ Production Ready  
**Last Updated:** December 22, 2025  
**Created By:** System Admin  

---

## 📞 Support

For issues or questions:
1. Check validation rules
2. Review error messages
3. Verify form data
4. Check browser console
5. Review server logs

---

*Complete Ledger Master system ready for managing all types of financial accounts!* 📚

