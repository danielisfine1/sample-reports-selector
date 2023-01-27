<?php

// There are going to be four sections. We're going to send a JSON object to the browser with keys "purpose", "focused_insight", "job_area" and "spotlight_records".
// Each section will have a collection of objects. The key will be the database column, and inside the object will be the value of the column (i.e. "URL":"https://...") and the display name "Hiring - Indiviual (General Level)".

// Purpose

$purposeCounter = array(0);

$purpose = array(
    array("name"=>"","DisplayName"=>"Choose one", "URL"=>""),
    array("name"=>"report_hiring_individual_general","DisplayName"=>"Hiring - Individual (General Level)", "URL"=>$_ENV["sub"]["report_hiring_individual_general"], "displayingon" => ""),
    array("name"=>"report_hiring_individual_manager","DisplayName"=>"Hiring - Individual (Manager Level)", "URL"=>$_ENV["sub"]["report_hiring_individual_manager"], "displayingon" => ""),
    array("name"=>"report_hiring_group","DisplayName"=>"Hiring - Group", "URL"=>$_ENV["sub"]["report_hiring_group"], "displayingon" => ""),
    array("name"=>"report_hiring_candidate_feedback","DisplayName"=>"Hiring - Candidate Feedback", "URL"=>$_ENV["sub"]["report_hiring_candidate_feedback"], "displayingon" => ""),
    array("name"=>"report_development_individual_general","DisplayName"=>"Development - Individual (General Level)", "URL"=>$_ENV["sub"]["report_development_individual_general"], "displayingon" => ""),
    array("name"=>"report_development_individual_manager","DisplayName"=>"Development - Individual (Manager Level)", "URL"=>$_ENV["sub"]["report_development_individual_manager"], "displayingon" => ""),
    array("name"=>"report_development_team","DisplayName"=>"Development - Team/Group", "URL"=>$_ENV["sub"]["report_development_team"], "displayingon" => "")
);

$i = 1;

foreach($purpose as &$purposeItem) {

    if ($purposeItem["URL"] != "" || $purposeItem["URL"] != null) {
        $i = 0;
        $purposeCounter = array();
    }
}

foreach($purpose as &$purposeItem) {

    if ($purposeItem["URL"] != "" || $purposeItem["URL"] != null) {
        $purposeItem["displayingon"] = "dropdown_select_$i";
        array_push($purposeCounter, $i);
        $i++;
    }
}

// Focused Insight

$focused_insightCounter = array(0);

$focused_insight = array(
    array("name"=>"","DisplayName"=>"Choose one", "URL"=>""),
    array("name"=>"report_competency","DisplayName"=>"Competency", "URL"=>$_ENV["sub"]["report_competency"]),
    array("name"=>"report_leadership","DisplayName"=>"Leadership", "URL"=>$_ENV["sub"]["report_leadership"]),
    array("name"=>"report_strengths","DisplayName"=>"Strengths", "URL"=>$_ENV["sub"]["report_strengths"]),
    array("name"=>"report_motivation","DisplayName"=>"Motivation", "URL"=>$_ENV["sub"]["report_motivation"]),
    array("name"=>"report_derailers","DisplayName"=>"Derailers", "URL"=>$_ENV["sub"]["report_derailers"]),
    array("name"=>"report_eq","DisplayName"=>"EQ", "URL"=>$_ENV["sub"]["report_eq"])
);

$j = 1;
foreach($focused_insight as &$focused_insightItem) {
    if ($focused_insightItem["URL"] != "" || $focused_insightItem["URL"] != null) {
        $focused_insightItem["displayingon"] = "dropdown_select_$j";
        $j++;
        array_push($focused_insightCounter, $j);
    }
}

// Job Area / Industry Focus

$job_areaCounter = array(0);

$job_area = array(
    array("name"=>"","DisplayName"=>"Choose one", "URL"=>""),
    array("name"=>"report_sales_roles","DisplayName"=>"Sales roles", "URL"=>$_ENV["sub"]["report_sales_roles"]),
    array("name"=>"report_service_roles","DisplayName"=>"Service roles", "URL"=>$_ENV["sub"]["report_service_roles"]),
    array("name"=>"report_technical_roles","DisplayName"=>"Technical roles", "URL"=>$_ENV["sub"]["report_technical_roles"]),
    array("name"=>"report_industry_specific","DisplayName"=>"Industry specific", "URL"=>$_ENV["sub"]["report_industry_specific"])
);

$k = 1;
foreach($job_area as &$job_areaItem) {
    if ($job_areaItem["URL"] != "" || $job_areaItem["URL"] != null) {
        $job_areaItem["displayingon"] = "dropdown_select_$k";
        $k++;
        array_push($job_areaCounter, $k);
    }
}

// Spotlight Reports

$spotlightCounter = array(0);

$spotlight = array(
    array("name"=>"","DisplayName"=>"Choose one", "URL"=>""),
    array("name"=>"report_name_1","DisplayName"=>"Report Name 1", "URL"=>$_ENV["sub"]["report_url_1"]),
    array("name"=>"report_name_2","DisplayName"=>"Report Name 2", "URL"=>$_ENV["sub"]["report_url_2"]),
    array("name"=>"report_name_3","DisplayName"=>"Report Name 3", "URL"=>$_ENV["sub"]["report_url_3"])
);

$l = 1;
foreach($spotlight as &$spotlightItem) {
    if ($spotlightItem["URL"] != "" || $spotlightItem["URL"] != null) {
        $spotlightItem["displayingon"] = "dropdown_select_$l";
        array_push($spotlightCounter, $l);
    }
}

?>

    <div id="preact">
    
    </div>

    <script>

        $(document).ready(function() {
            $('.year-dropdown').select2();
        });
        
    </script>

    <script type="module">

        import { h, render } from 'https://unpkg.com/preact@latest?module'
        import { useState, useEffect } from 'https://unpkg.com/preact@latest/hooks/dist/hooks.module.js?module'
        import { html } from 'https://unpkg.com/htm/preact/index.module.js?module'

        // Handle selection change...

        let purpose = <?php echo json_encode($purpose); ?>;
        let focused_insight = <?php echo json_encode($focused_insight); ?>;
        let job_area = <?php echo json_encode($job_area); ?>;
        let spotlight = <?php echo json_encode($spotlight); ?>;

        function selectionChange(value, section, setSection, currentSelectID, nameForInput, setNameForInput, valueForInput, setValueForInput) {

            let updatedArray = section.map((item) => {

                if (item.name === value && item.DisplayName !== 'Choose one') {
                    item.displayingon = currentSelectID;
                    setNameForInput(item.name);
                    setValueForInput(item.URL);
                } else if (item.displayingon === currentSelectID && item.DisplayName !== 'Choose one') {
                    item.displayingon = undefined;
                    setNameForInput("");
                    setValueForInput("");
                }

                return item;

            });

            setSection(updatedArray);

        }

        function removeInput(counter, setter, currentSelectID, itemToRemove, section, setSection, nameForInput, setNameForInput, selectedValue, setSelectedValue) {

            let parent = document.getElementById(currentSelectID).parentNode;
            parent.parentNode.removeChild(parent);

            setNameForInput("");
            setSelectedValue("");

            let arrayWithoutRemoved = counter.filter((arrayEl) => {
                return arrayEl !== itemToRemove;
            });

            setter(arrayWithoutRemoved);            
            
            let updatedArray = section.map((item) => {

                if (item.displayingon === currentSelectID) {
                    item.displayingon = undefined;
                }

                return item;

            });

            setSection(updatedArray);
            
        }

        function renderOptions(section, setSection, currentSelectID, counter, setter, item, i) {
            
            var [nameForInput, setNameForInput] = useState("");
            var [selectedValue, setSelectedValue] = useState("");

            function renderRemove() {
                if (i >= 1) {
                    return (

                        h('div', {style:'display:flex;align-items:center;justify-content:center;width:10%;'}, [

                            h('a', {class: "inputRemoveButton", style:'cursor:pointer', onClick: () => removeInput(counter, setter, currentSelectID, item, section, setSection, nameForInput, setNameForInput, selectedValue, setSelectedValue)}, 'x')

                        ])
                        
                        )
                }

            };
            
            return (

                h('div', { style:'display:flex;flex-direction:row;' }, [

                    h('div', {class: 'dropdown_input_container', style: 'width:90%'}, [                 
                    
                    h('select', { id: currentSelectID, class: 'dropdown_input_select form-control year-dropdown', style: 'padding:0;', onChange: (e) => selectionChange(e.target.value, section, setSection, currentSelectID, nameForInput, setNameForInput, selectedValue, setSelectedValue) }, [
                        section.map((item) => {

                            if (item.displayingon !== undefined && item.DisplayName !== 'Choose one' && item.displayingon !== "") {
                                if (item.displayingon === currentSelectID) {
                                    setSelectedValue(item.URL);
                                    setNameForInput(item.name);
                                    return h('option', { value: item.name, selected: true }, item.DisplayName)
                                }
                            } else {
                                return h('option', { value: item.name }, item.DisplayName)
                            }

                        })
                    ]),
                    
                    h('input', { type: "text", class: "form-control dropdown_text_input", name: nameForInput, value: selectedValue }, null),

                    ]),

                    renderRemove()

                ])


            );
            
        };

        function renderSection(section, setSection, counter, setter) {

            function lastOneInArray () {

                var last =  counter[counter.length-1] === undefined ? 0 : counter[counter.length-1] + 1;
                return last;

            }

            var addReportButton = () => {
                if (counter.length <= section.length - 2) {
                    return h('a', { style:'cursor:pointer',  onClick: () => {setter([... counter, lastOneInArray()]); reloadSelect2()} }, 'Add sample report');
                }
            }
            
            return h('div', { class: 'dropdowns_inputs' }, [

                counter.map((item, i) => {

                    var currentSelectID = `dropdown_select_${item}`;

                    return (

                        renderOptions(section, setSection, currentSelectID, counter, setter, item, i)

                    )
                    
                }),

                addReportButton()

            ])
        };

        function renderSections() {

            var [stpurpose, setPurpose] = useState(purpose);
            var [stfocused_insight, setFocusedInsight] = useState(focused_insight);
            var [stjob_area, setJobArea] = useState(job_area);
            var [stspotlight, setSpotlight] = useState(spotlight);

            const [purposeCounter, setPurposeCounter] = useState(<?php echo json_encode($purposeCounter); ?>);
            const [focusedInsightCounter, setFocusedInsightCounter] = useState(<?php echo json_encode($focused_insightCounter); ?>);
            const [jobAreaCounter, setJobAreaCounter] = useState(<?php echo json_encode($job_areaCounter); ?>);
            const [spotlightCounter, setSpotlightCounter] = useState(<?php echo json_encode($spotlightCounter); ?>);

            useEffect(() => {
                console.log('useEffect');
            // initialize select2
            $('select.year-dropdown').select2('destroy');
            $('select.year-dropdown').select2();

            // // cleanup function to destroy select2 when component unmounts
            // return () => {
            //     $('select.year-dropdown').select2('destroy');
            // }
            }, [stpurpose, stfocused_insight, stjob_area, stspotlight, purposeCounter, focusedInsightCounter, jobAreaCounter, spotlightCounter]);

            // useEffect(() => {
            //     $(document).ready(function(){
            //         //destroy all instances of select2
            //         $('.select2').select2('destroy');
            //         //initialize select2 again
            //         $('.select2').select2();
            //     });
            // }, [purposeCounter, focusedInsightCounter, jobAreaCounter, spotlightCounter, stpurpose, stfocused_insight,  stjob_area,  stspotlight]);


            // useEffect(() => {
            //     // destroy and re-initialize select2
            //     $('.year-dropdown').select2('destroy');
            //     $('.year-dropdown').select2();
            // }, [purposeCounter, focusedInsightCounter, jobAreaCounter, spotlightCounter, stpurpose, stfocused_insight,  stjob_area,  stspotlight]);

            <? // Show pre-selected options ?>

            // On page load, check if there are any pre-selected options and add them to the counter array...

            return h('div', {class: 'sections_container'}, [
                h('div', {class: 'sample_selector_section'}, [h('h4', {}, "Purpose"), renderSection(stpurpose, setPurpose, purposeCounter, setPurposeCounter)]),
                h('div', {class: 'sample_selector_section'}, [h('h4', {}, "Focused Insight"), renderSection(stfocused_insight, setFocusedInsight, focusedInsightCounter, setFocusedInsightCounter)]),
                h('div', {class: 'sample_selector_section'}, [h('h4', {}, "Job Area/Industry Focus"), renderSection(stjob_area, setJobArea, jobAreaCounter, setJobAreaCounter)]),
                h('div', {class: 'sample_selector_section'}, [h('h4', {}, "Spotlight Records"), renderSection(stspotlight, setSpotlight, spotlightCounter, setSpotlightCounter)])
            ]);

        };

        function Counter () {
            const [testVar, setTestVar] = useState(0);
            return h("div", {}, [
                h("button", { onClick: () => setTestVar(testVar + 1) }, "Click me"),
                h("p", {}, `You clicked ${testVar} times`)
            ])
        };

        render(html`<${renderSections}/>`, document.getElementById("preact"));

    </script>


<style>

    .sample_selector_section {
        margin: 35px 0;
    }

    .dropdown_input_container {
        display: flex;
        flex-direction: column;
        width: 100%;
        margin: 10px 0;
    }

    .dropdown_input_container input {
        margin: 0 0 0 5px;
        width: 250px;
    }

    .dropdown_input_container select {
        margin: 0 0 0 5px;
        width: 100%;
    }

    .dropdowns_inputs {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .dropdown_input_container {
        display:flex;
        flex-direction: row;
        width: 100%;
    }

    .dropdown_input_select {
        box-shadow: 0 3px 6px 0 rgb(0 0 0 / 16%);
        border:none;
        outline:none;
    }

    .dropdown_text_input {
        border:none;
        outline:none;
    }

</style>