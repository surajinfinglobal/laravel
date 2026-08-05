<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Projects</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/multiple-select@1.7.0/dist/multiple-select.min.css">
<link rel="stylesheet"
href="{{ asset('css/admin-project.css') }}">

<!-- Inline fix: hides the default scrollbar inside multiple-select dropdown
     without removing scroll functionality (works for both Webkit + Firefox) -->
<style>
    .ms-drop ul {
        max-height: 250px;
        overflow-y: auto;
        scrollbar-width: none;      /* Firefox */
        -ms-overflow-style: none;   /* old Edge / IE */
    }
    .ms-drop ul::-webkit-scrollbar {
        display: none;              /* Chrome, Safari, new Edge */
    }

    /* Dark glass-themed box showing selected categories, sits just above dropdown */
    .selected-values-box {
        margin-bottom: 8px;
        padding: 8px 12px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }
    .selected-values-box label {
        font-size: 12px;
        font-weight: 600;
        display: block;
        margin-bottom: 6px;
        color: rgba(255, 255, 255, 0.6);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .selected-values-box .selected-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        min-height: 20px;
    }
    .selected-values-box .selected-tags span {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: #fff;
        font-size: 12px;
        padding: 3px 10px;
        border-radius: 20px;
    }
    .selected-values-box .selected-tags .empty-text {
        color: rgba(255, 255, 255, 0.35);
        font-size: 12px;
        background: none;
        border: none;
        padding: 3px 0;
    }

    /* Hide the search/filter input that multiple-select shows inside the dropdown */
    .ms-drop .ms-search {
        display: none !important;
    }

    /* Fixed-width wrapper so both the selected-box and dropdown always match
       and never resize based on number of selected tags / text length */
    .filter-wrapper {
        width: 280px;
        box-sizing: border-box;
    }
    .selected-values-box,
    .filter-box,
    .ms-parent {
        width: 100% !important;
        box-sizing: border-box;
    }

    /* ===== Dark glass theme override for multiple-select plugin ===== */

    /* Closed dropdown box (the clickable field showing "X selected") */
    .ms-choice {
        background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(255, 255, 255, 0.12) !important;
        border-radius: 10px !important;
        color: #fff !important;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        white-space: nowrap;
        overflow: hidden;
    }
    .ms-choice > span {
        color: rgba(255, 255, 255, 0.85) !important;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .ms-choice > span.placeholder {
        color: rgba(255, 255, 255, 0.4) !important;
    }
    .ms-choice .arrow {
        border-color: rgba(255, 255, 255, 0.6) transparent transparent transparent !important;
    }
    .ms-choice:focus,
    .ms-choice:active,
    .ms-choice:hover,
    .ms-choice.ms-choice-open {
        background: rgba(255, 255, 255, 0.05) !important;
        outline: none !important;
        box-shadow: none !important;
        -webkit-tap-highlight-color: transparent;
    }

    /* Open dropdown panel */
    .ms-drop {
        background: rgba(20, 20, 25, 0.85) !important;
        border: 1px solid rgba(255, 255, 255, 0.12) !important;
        border-radius: 10px !important;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
    }

    /* Each option row: text on the left, tick/checkbox aligned to the right.
       display:flex overrides the plugin's own absolute-positioned checkbox,
       which was causing the tick to overlap the text. */
    .ms-drop ul li label,
    .ms-drop ul li.multiple label {
        display: flex !important;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 8px 12px !important;
        color: rgba(255, 255, 255, 0.85) !important;
    }
    .ms-drop ul li label input[type="checkbox"] {
        position: static !important;   /* cancel plugin's absolute positioning */
        margin: 0 !important;
        order: 2;                      /* forces checkbox after the text */
        flex-shrink: 0;
        width: 16px;
        height: 16px;
        accent-color: #ffffff;
    }
    .ms-drop ul li.hover,
    .ms-drop ul li label:hover {
        background: rgba(255, 255, 255, 0.08) !important;
    }
    .ms-drop ul li.selected {
        background: rgba(255, 255, 255, 0.05) !important;
    }
    
</style>

</head>

<body>

<link rel="stylesheet" href="{{ asset('css/home.css') }}">

<!-- ================= NAVBAR ================= -->
<x-navbar />

<div class="toolbar-container">
<div class="toolbar">
    <div class="ambient-bg" aria-hidden="true">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
</div>
    <div class="toolbar-inner">

        <!-- Search Bar -->
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input 
                type="text" 
                id="search" 
                placeholder="Search projects...">
        </div>

        <!-- Dropdown Filter with selected-values box sitting just above it -->
        <div class="filter-wrapper">

            <!-- NEW: Shows currently selected categories as tags -->
            <!-- <div class="selected-values-box">
                <label for="selected-values">Selected Categories</label>
                <div class="selected-tags" id="selected-tags">
                    <span class="empty-text">No category selected</span>
                </div>
            </div> -->

            <div class="filter-box" id="technology"
                name="technology[]"
                multiple>
                <select id="category-filter" multiple>
                    <option value="All Categories">All Categories</option>
                    <option value="Laravel">Laravel</option>
                    <option value="PHP">PHP</option>
                    <option value="UI/UX Design">UI/UX Design</option>
                    <option value="Web Development">Web Development</option>
                    <option value="Mobile App">Mobile App</option>
                </select>
            </div>

        </div>

    </div>
</div>
</div>

<!-- ================= PROJECTS ================= -->

<div class="projects-wrapper">

</div>

<!-- Removed duplicate jquery <script> tag that was here before -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://unpkg.com/multiple-select@1.7.0/dist/multiple-select.min.js"></script>

<!-- NOTE: A <script> tag can't have both src AND inline code together —
     browser ignores the inline part if src is set. That's why original code
     wasn't initializing multipleSelect at all. Split into two tags below. -->
<script src="{{ asset('js/admin-project.js') }}"></script>

<script>
    var $select = $('#category-filter');

    $(function() {
        $select.multipleSelect({
            filter: false,   // no search input inside dropdown, per requirement

            // Fires every time user checks/unchecks an option
            onClick: function() {
                updateSelectedValues();
            },
            onCheckAll: function() {
                updateSelectedValues();
            },
            onUncheckAll: function() {
                updateSelectedValues();
            }
        });

        updateSelectedValues();
    });

    // Reads currently selected values from dropdown,
    // renders them as tags in the box above, and logs the array to console
    function updateSelectedValues() {
        var selectedData = $select.multipleSelect('getSelects'); // returns array

        console.log(selectedData);

        var $tagsBox = $('#selected-tags');
        $tagsBox.empty();

        if (selectedData.length === 0) {
            $('<span class="empty-text">No category selected</span>').appendTo($tagsBox);
        } else {
            $.each(selectedData, function(index, value) {
                $('<span></span>').text(value).appendTo($tagsBox);
            });
        }

        $('#technology .ms-choice > span').text('Select Categories');

        return selectedData;
    }
</script>

</body>
</html>