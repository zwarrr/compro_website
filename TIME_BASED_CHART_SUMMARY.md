# Time-Based Chart Enhancement Summary

## Tujuan
Mengubah chart menjadi time-based dengan:
- X-axis: Jangka waktu (tanggal/periode)
- Y-axis: Jumlah data
- Filter jenis data: Layanan, Client, Karyawan, Testimoni, Galeri
- Filter periode: Per Hari, Per Minggu, Per Bulan

## Perubahan yang Dilakukan

### 1. DashboardController - Method Baru
**File**: `app/Http/Controllers/Admin/DashboardController.php`

**Method Baru**: `getChartData(Request $request)`

**Fungsi**:
- Menerima parameter `type` (layanan, client, karyawan, testimoni, galeri)
- Menerima parameter `period` (daily, weekly, monthly)
- Menghitung jumlah data berdasarkan `created_at`
- Return JSON dengan `labels` dan `data`

**Logika Per Period**:

1. **Daily (Per Hari)**: Last 7 days
   ```php
   for ($i = 6; $i >= 0; $i--) {
       $date = now()->subDays($i);
       $labels[] = $date->format('d M'); // "16 Oct"
       $count = Model::whereDate('created_at', $date)->count();
   }
   ```

2. **Weekly (Per Minggu)**: Last 8 weeks
   ```php
   for ($i = 7; $i >= 0; $i--) {
       $startOfWeek = now()->subWeeks($i)->startOfWeek();
       $endOfWeek = now()->subWeeks($i)->endOfWeek();
       $labels[] = 'Week ' . $startOfWeek->format('d M');
       $count = Model::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
   }
   ```

3. **Monthly (Per Bulan)**: Last 6 months
   ```php
   for ($i = 5; $i >= 0; $i--) {
       $date = now()->subMonths($i);
       $labels[] = $date->format('M Y'); // "Oct 2025"
       $count = Model::whereYear('created_at', $date->year)
                     ->whereMonth('created_at', $date->month)
                     ->count();
   }
   ```

**Response Format**:
```json
{
    "labels": ["10 Oct", "11 Oct", "12 Oct", "13 Oct", "14 Oct", "15 Oct", "16 Oct"],
    "data": [5, 3, 7, 2, 4, 6, 8]
}
```

### 2. Routes - AJAX Endpoint
**File**: `routes/web.php`

**Route Baru**:
```php
Route::get('dashboard/chart-data', [DashboardController::class, 'getChartData'])
    ->name('dashboard.chart-data');
```

**URL**: `/admin/dashboard/chart-data?type=layanan&period=daily`

### 3. View - Filter UI & Dynamic Chart
**File**: `resources/views/admin/dashboard/index.blade.php`

#### A. Filter Jenis Data (Data Type)

**HTML Structure**:
```blade
<div class="flex flex-wrap gap-2">
    <button onclick="updateChartType('layanan')" id="btn-layanan" class="filter-btn active">
        <svg>...</svg> Layanan
    </button>
    <button onclick="updateChartType('client')" id="btn-client" class="filter-btn">
        <svg>...</svg> Client
    </button>
    <!-- ... 3 more buttons -->
</div>
```

**Button States**:
- Active: Background color sesuai jenis data + text white
- Inactive: `bg-gray-100` + `text-gray-700`

**Color Mapping**:
- Layanan: `bg-blue-500` (#3B82F6)
- Client: `bg-green-500` (#10B981)
- Karyawan: `bg-purple-500` (#8B5CF6)
- Testimoni: `bg-orange-500` (#F59E0B)
- Galeri: `bg-pink-500` (#EC4899)

#### B. Filter Periode (Time Period)

**HTML Structure**:
```blade
<div class="flex flex-wrap gap-2">
    <button onclick="updateChartPeriod('daily')" id="btn-daily" class="period-btn active">
        <svg>...</svg> Per Hari (7 Hari)
    </button>
    <button onclick="updateChartPeriod('weekly')" id="btn-weekly" class="period-btn">
        <svg>...</svg> Per Minggu (8 Minggu)
    </button>
    <button onclick="updateChartPeriod('monthly')" id="btn-monthly" class="period-btn">
        <svg>...</svg> Per Bulan (6 Bulan)
    </button>
</div>
```

**Button States**:
- Active: `bg-primary` (red) + `text-white`
- Inactive: `bg-gray-100` + `text-gray-700`

#### C. Loading State

**HTML**:
```blade
<div id="chart-loading" class="absolute inset-0 bg-white bg-opacity-90 hidden">
    <div class="text-center">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary"></div>
        <p class="text-sm text-gray-600">Memuat data...</p>
    </div>
</div>
```

**States**:
- Hidden by default: `hidden` class
- Show during fetch: `flex` class (replace `hidden`)

### 4. JavaScript - Dynamic Chart Logic

#### A. Global Variables
```javascript
let chart = null;              // Chart.js instance
let currentType = 'layanan';   // Current data type
let currentPeriod = 'daily';   // Current period
```

#### B. Color Schemes
```javascript
const colorSchemes = {
    layanan: { primary: '#3B82F6', gradient: 'rgba(59, 130, 246, 0.1)' },
    client: { primary: '#10B981', gradient: 'rgba(16, 185, 129, 0.1)' },
    karyawan: { primary: '#8B5CF6', gradient: 'rgba(139, 92, 246, 0.1)' },
    testimoni: { primary: '#F59E0B', gradient: 'rgba(245, 158, 11, 0.1)' },
    galeri: { primary: '#EC4899', gradient: 'rgba(236, 72, 153, 0.1)' }
};
```

#### C. Functions

**1. `initChart(labels, data, type)`**
- Destroy existing chart if exists
- Create new Chart.js instance
- Apply color scheme based on type
- Configure axes with titles:
  - Y-axis: "Jumlah Data"
  - X-axis: "Periode Waktu"
- Set smooth line with tension 0.4
- Enable tooltips with custom format

**2. `loadChartData()` - Async**
- Show loading spinner
- Fetch data from API endpoint
- Pass `currentType` and `currentPeriod` as query params
- Call `initChart()` with response data
- Hide loading spinner

**3. `updateChartType(type)`**
- Update `currentType` variable
- Change button states (active/inactive)
- Apply appropriate color to active button
- Call `loadChartData()`

**4. `updateChartPeriod(period)`**
- Update `currentPeriod` variable
- Change button states (active/inactive)
- Call `loadChartData()`

**5. DOMContentLoaded Event**
- Initialize chart on page load
- Default: Layanan + Daily

#### D. Chart.js Configuration

**Dataset Config**:
```javascript
{
    label: 'Jumlah Layanan',           // Dynamic based on type
    data: [5, 3, 7, 2, 4, 6, 8],       // From API
    borderColor: '#3B82F6',             // Primary color
    backgroundColor: 'rgba(..., 0.1)',  // Gradient fill
    borderWidth: 3,
    fill: true,
    tension: 0.4,                       // Smooth curve
    pointRadius: 5,
    pointHoverRadius: 7
}
```

**Scales Config**:
```javascript
scales: {
    y: {
        beginAtZero: true,
        stepSize: 1,                    // Integer only
        title: { text: 'Jumlah Data' }
    },
    x: {
        title: { text: 'Periode Waktu' }
    }
}
```

**Tooltip Config**:
```javascript
tooltip: {
    callbacks: {
        label: function(context) {
            return context.parsed.y + ' data ditambahkan';
        }
    }
}
```

## Data Flow

```
User Action (Click Filter Button)
    ↓
updateChartType() or updateChartPeriod()
    ↓
Update global variables (currentType, currentPeriod)
    ↓
loadChartData()
    ↓
AJAX Request to /admin/dashboard/chart-data
    ↓
DashboardController::getChartData()
    ↓
Query database with date filters
    ↓
Return JSON { labels, data }
    ↓
initChart(labels, data, type)
    ↓
Chart.js renders line chart with new data
```

## Filter Combinations

Total combinations: **5 types × 3 periods = 15 combinations**

### Examples:

1. **Layanan + Daily**
   - X-axis: "10 Oct", "11 Oct", "12 Oct", "13 Oct", "14 Oct", "15 Oct", "16 Oct"
   - Y-axis: Count of Layanan created per day
   - Color: Blue

2. **Client + Weekly**
   - X-axis: "Week 09 Sep", "Week 16 Sep", "Week 23 Sep", ..., "Week 16 Oct"
   - Y-axis: Count of Clients created per week
   - Color: Green

3. **Testimoni + Monthly**
   - X-axis: "May 2025", "Jun 2025", "Jul 2025", "Aug 2025", "Sep 2025", "Oct 2025"
   - Y-axis: Count of Testimonials created per month
   - Color: Orange

## Features

### ✅ Interactive Filters
- Click data type button → Chart updates with new color and data
- Click period button → Chart updates with new time range
- Smooth transitions between states

### ✅ Dynamic Color Schemes
- Each data type has unique color
- Color applied to:
  - Active filter button
  - Chart line
  - Chart fill gradient
  - Chart points

### ✅ Loading States
- Spinner shown during data fetch
- Prevents multiple simultaneous requests
- User-friendly loading message

### ✅ Responsive Design
- Filter buttons wrap on small screens
- Chart maintains aspect ratio
- Touch-friendly button sizes

### ✅ Time-Based Analytics
- See growth trends over time
- Compare different periods
- Identify patterns (daily spikes, weekly trends, monthly growth)

## Chart Axes

### X-Axis (Periode Waktu)
- **Daily**: Date format "d M" (16 Oct)
- **Weekly**: "Week d M" (Week 09 Oct)
- **Monthly**: Month format "M Y" (Oct 2025)
- **Grid**: Hidden (clean look)
- **Title**: "Periode Waktu"

### Y-Axis (Jumlah Data)
- **Begin at zero**: Always starts from 0
- **Step size**: 1 (integer values only)
- **Grid**: Light gray with 5% opacity
- **Title**: "Jumlah Data"

## Button Interactions

### Data Type Buttons
```
Click Event → updateChartType(type)
    ↓
1. Reset all filter buttons to inactive state (gray)
2. Set clicked button to active state (colored)
3. Apply type-specific color (blue/green/purple/orange/pink)
4. Update currentType variable
5. Fetch new data from API
6. Re-render chart with new color scheme
```

### Period Buttons
```
Click Event → updateChartPeriod(period)
    ↓
1. Reset all period buttons to inactive state (gray)
2. Set clicked button to active state (primary red)
3. Update currentPeriod variable
4. Fetch new data from API
5. Re-render chart with new date range
```

## Error Handling

**Network Error**:
```javascript
catch (error) {
    console.error('Error loading chart data:', error);
    alert('Gagal memuat data chart. Silakan refresh halaman.');
}
```

**Empty Data**:
- Chart still renders with 0 values
- Y-axis shows 0
- No data points displayed

## Performance Optimizations

1. **Chart Reuse**: Destroy old chart before creating new one
2. **Debouncing**: Not needed (user clicks once)
3. **Caching**: Browser caches API responses
4. **Lazy Loading**: Chart loads after page render

## Browser Compatibility

- ✅ Chrome 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Edge 90+
- ✅ Mobile browsers

## Future Enhancements

1. **Date Range Picker**: Custom start/end dates
2. **Compare Mode**: Show multiple data types on same chart
3. **Export**: Download chart as PNG/PDF
4. **Real-time Updates**: WebSocket for live data
5. **Annotations**: Mark important events on timeline
6. **Zoom**: Pan and zoom on chart
7. **Data Table**: Toggle between chart and table view
8. **Trend Analysis**: Show growth rate percentage

## Files Modified

1. ✅ `app/Http/Controllers/Admin/DashboardController.php`
   - Added `getChartData()` method
   - Implemented time-based queries

2. ✅ `routes/web.php`
   - Added AJAX route for chart data

3. ✅ `resources/views/admin/dashboard/index.blade.php`
   - Added data type filter buttons
   - Added period filter buttons
   - Added loading state
   - Replaced static chart with dynamic chart
   - Added JavaScript for filter interactions
   - Added Chart.js initialization logic

## Testing Checklist

### Functionality
- [ ] Click "Layanan" button → Blue chart appears
- [ ] Click "Client" button → Green chart appears
- [ ] Click "Karyawan" button → Purple chart appears
- [ ] Click "Testimoni" button → Orange chart appears
- [ ] Click "Galeri" button → Pink chart appears
- [ ] Click "Per Hari" → Shows last 7 days
- [ ] Click "Per Minggu" → Shows last 8 weeks
- [ ] Click "Per Bulan" → Shows last 6 months
- [ ] Loading spinner shows during fetch
- [ ] Chart updates smoothly without page refresh

### Data Accuracy
- [ ] Daily counts match database records
- [ ] Weekly counts sum correctly
- [ ] Monthly counts sum correctly
- [ ] Date labels display in correct format
- [ ] Timezone handled correctly

### UI/UX
- [ ] Filter buttons highlight correctly
- [ ] Colors match data type
- [ ] Buttons responsive on mobile
- [ ] Chart readable on small screens
- [ ] Tooltips show correct information
- [ ] Smooth transitions between states

### Error Handling
- [ ] Network error shows alert
- [ ] Empty data displays gracefully
- [ ] Console errors handled

## Database Requirements

All models must have `created_at` timestamp:
- ✅ Layanan
- ✅ Client
- ✅ Karyawan
- ✅ Testimoni
- ✅ Galeri

**Note**: If `created_at` is null for some records, they won't be counted in time-based queries.

## API Response Examples

### Daily - Layanan
```json
{
    "labels": ["10 Oct", "11 Oct", "12 Oct", "13 Oct", "14 Oct", "15 Oct", "16 Oct"],
    "data": [2, 0, 3, 1, 0, 2, 5]
}
```

### Weekly - Client
```json
{
    "labels": ["Week 09 Sep", "Week 16 Sep", "Week 23 Sep", "Week 30 Sep", "Week 07 Oct", "Week 14 Oct", "Week 21 Oct", "Week 28 Oct"],
    "data": [5, 8, 3, 7, 12, 9, 15, 11]
}
```

### Monthly - Testimoni
```json
{
    "labels": ["May 2025", "Jun 2025", "Jul 2025", "Aug 2025", "Sep 2025", "Oct 2025"],
    "data": [23, 18, 31, 27, 35, 42]
}
```

## Notes

- Chart height fixed at 320px (increased from 300px for better visibility)
- Filter buttons use SVG icons for better visuals
- Period buttons show data range in label (e.g., "Per Hari (7 Hari)")
- Color schemes carefully chosen for accessibility and brand consistency
- Loading state prevents user from clicking buttons during data fetch
