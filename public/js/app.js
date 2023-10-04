// var token = $('meta[name=csrf-token]').attr('content');
// function formModal(route) {

//     $.get(route, function (res) {


//         const initializeWaveSurfer = (newUrl) => {

//             //wav
//             // Create a second timeline
//             const bottomTimline = TimelinePlugin.create({
//                 height: 15,
//                 timeInterval: 2,
//                 primaryLabelInterval: 10,
//                 style: {
//                     fontSize: '10px',
//                     color: '#000000',
//                 },
//             })

//             if (wavesurfer) {
//                 // Destroy the existing WaveSurfer instance to clear it
//                 wavesurfer.destroy();
//             }

//             wavesurfer = WaveSurfer.create({
//                 container: '#waveform',
//                 height: 200,
//                 audioRate: 1,
//                 splitChannels: false,
//                 normalize: false,
//                 waveColor: '#4F4A85',
//                 progressColor: '#383351',
//                 url: newUrl,
//                 cursorColor: '#b3aefb',
//                 cursorWidth: 1,
//                 //barWidth: 1,
//                 //barGap: 1,
//                 barRadius: 1,
//                 barHeight: null,
//                 barAlign: "",
//                 minPxPerSec: 1,
//                 fillParent: true,
//                 plugins: [
//                     Hover.create({
//                         lineColor: '#ff0000',
//                         lineWidth: 2,
//                         labelBackground: '#555',
//                         labelColor: '#fff',
//                         labelSize: '11px',
//                     }),
//                     Minimap.create({
//                         height: 30,
//                         waveColor: '#ddd',
//                         progressColor: '#ff0000',
//                     }), /* topTimeline,*/ bottomTimline
//                 ],
//             })

//             const wsRegions = wavesurfer.registerPlugin(RegionsPlugin.create())
//             const playButton = document.querySelector('#play')
//             const forwardButton = document.querySelector('#forward')
//             const backButton = document.querySelector('#backward')
//             const stopButton = document.querySelector('#stop')
//             const toggleMuteButton = document.querySelector('#toggleMuteBtn')
//             const setMuteOnButton = document.querySelector('#setMuteOnBtn')
//             const setMuteOffButton = document.querySelector('#setMuteOffBtn')



//             let preservePitch = true
//             const speeds = [0.25, 0.5, 1, 2, 4]

//             // Toggle pitch preservation
//             /* document.querySelector('#pitch').addEventListener('change', (e) => {
//                 preservePitch = e.target.checked
//                 wavesurfer.setPlaybackRate(wavesurfer.getPlaybackRate(), preservePitch)
//             }) */

//             // Set the playback rate
//             document.querySelector('#speed').addEventListener('input', (e) => {
//                 const speed = speeds[e.target.valueAsNumber]
//                 document.querySelector('#rate').textContent = speed.toFixed(2)
//                 wavesurfer.setPlaybackRate(speed, preservePitch)
//                 wavesurfer.play()
//             })

//             var volumeInput = document.querySelector('#volume');
//             var onChangeVolume = function (e) {
//                 wavesurfer.setVolume(e.target.value);
//                 const volume = parseFloat(e.target.value * 10);
//                 document.querySelector('#vol').textContent = volume.toFixed(2)
//                 //console.log(e.target.value);
//             };
//             volumeInput.addEventListener('input', onChangeVolume);
//             volumeInput.addEventListener('change', onChangeVolume);


//             const fetchTooltipsFromDB = () => {
//                 // Perform an API request or database query to retrieve tooltip data
//                 return [{
//                     startTime: 10,
//                     endTime: 15,
//                     content: 'ทดสอบ'
//                 },
//                 {
//                     startTime: 20,
//                     endTime: 25,
//                     content: 'เสียงชัดเจน'
//                 },
//                     // More tooltip data...
//                 ];
//             };

//             const updateTimer = () => {
//                 const formattedTime = secondsToTimestamp(wavesurfer.getCurrentTime());
//                 $('#waveform-time-indicator .time').text(formattedTime);
//             };

//             const secondsToTimestamp = (seconds) => {
//                 seconds = Math.floor(seconds);
//                 const h = Math.floor(seconds / 3600);
//                 const m = Math.floor((seconds - (h * 3600)) / 60);
//                 const s = seconds - (h * 3600) - (m * 60);

//                 const padZero = (value) => (value < 10 ? '0' + value : value);

//                 return `${padZero(h)}:${padZero(m)}:${padZero(s)}`;
//             };


//             wavesurfer.on('ready', updateTimer)
//             wavesurfer.on('audioprocess', updateTimer)
//             wavesurfer.on('seek', updateTimer)


//             wavesurfer.once('decode', () => {
//                 const slider = document.querySelector('input[type="range"]')

//                 slider.addEventListener('input', (e) => {
//                     const minPxPerSec = e.target.valueAsNumber
//                     wavesurfer.zoom(minPxPerSec)
//                 })

//                 document.querySelector('button').addEventListener('click', () => {
//                     wavesurfer.playPause()
//                 })

//                 toggleMuteButton.onclick = function () {
//                     wavesurfer.toggleMute();
//                 };

//                 setMuteOnButton.onclick = function () {
//                     wavesurfer.setMute(true);
//                 };

//                 setMuteOffButton.onclick = function () {
//                     wavesurfer.setMute(false);
//                 };

//                 playButton.onclick = () => {
//                     wavesurfer.playPause()
//                 }

//                 stopButton.onclick = () => {
//                     wavesurfer.stop()
//                 }


//                 forwardButton.onclick = () => {
//                     wavesurfer.skip(5)
//                 }

//                 backButton.onclick = () => {
//                     wavesurfer.skip(-5)
//                 }

//                 const totalTime = wavesurfer.getDuration()
//                 document.querySelector('#duration').textContent = secondsToTimestamp(totalTime);

//                 wavesurfer.setVolume(0.4);
//                 document.querySelector('#volume').value = wavesurfer.getVolume();

//                 const tooltipsData = fetchTooltipsFromDB();
//                 // Iterate through the tooltip data and add tooltips to the waveform
//                 tooltipsData.forEach(({
//                     startTime,
//                     endTime,
//                     content
//                 }) => {
//                     // Create a region for each tooltip
//                     const region = wsRegions.addRegion({
//                         start: startTime,
//                         end: endTime,
//                         color: 'rgba(255, 0, 0, 0.1)', // Set your desired tooltip color
//                     });

//                     const tooltip = document.createElement('div');
//                     tooltip.className = 'region-tooltip';
//                     tooltip.style.paddingLeft = '10px';
//                     tooltip.textContent = content;

//                     // Attach the tooltip to the region's element
//                     region.element.appendChild(tooltip);
//                     customDialog.style.display = 'none';

//                 });

//                 /*  // Create a button to remove the region
//                 const regionButton = document.createElement('button');
//                 regionButton.className = 'remove-region-button';
//                 regionButton.textContent = 'X';

//                 // Add a click event listener to remove the region when the button is clicked
//                 regionButton.addEventListener('click', () => {
//                     const activeRegion = wsRegions.getActiveRegion();
//                     if (activeRegion) {
//                         activeRegion.remove();
//                     }
//                 });
//                */
//                 // Append the button to the container
//                 //const container = document.querySelector('#waveform-container');
//                 //container.appendChild(regionButton);
//             });

//             const customDialog = document.getElementById('custom-dialog');
//             const contentInput = document.getElementById('content-input');
//             const addContentButton = document.getElementById('add-content-button');

//             wsRegions.enableDragSelection({
//                 color: 'rgba(255, 0, 0, 0.1)',
//                 //content: 'Region Content',
//             });

//             let currentRegion;

//             // Debug statement to check if the code leading up to onRegionCreated is executing
//             console.log('Before onRegionCreated');

//             // Add a listener for the region-created event
//             wsRegions.on('region-created', (region) => {
//                 // Callback code
//                 console.log('Region Created:', region);

//                 const button = document.createElement('button');
//                 button.className = 'remove-region-button';
//                 button.textContent = 'X';

//                 customDialog.style.display = 'block';

//                 addContentButton.addEventListener('click', () => {
//                     if (currentRegion) {
//                         // Remove any existing tooltips in the current region
//                         const existingTooltips = currentRegion.element.querySelectorAll(
//                             '.region-tooltip');
//                         existingTooltips.forEach((tooltip) => {
//                             tooltip.remove();
//                         });

//                         // Create a tooltip element
//                         const tooltip = document.createElement('div');
//                         const content = contentInput.value;
//                         tooltip.className = 'region-tooltip';
//                         tooltip.textContent = content; // Replace with your tooltip text
//                         tooltip.style.paddingLeft = '10px';
//                         customDialog.style.display = 'none'; // Close the dialog box
//                         currentRegion.element.appendChild(tooltip);
//                     }
//                 });

//                 // Attach a click event handler to the button
//                 button.addEventListener('click', () => {
//                     // Remove the region when the button is clicked
//                     region.remove();
//                 });

//                 // Append the button to the region element
//                 region.element.appendChild(button);

//                 currentRegion = region;
//             });

//             wsRegions.on('region-updated', (region) => {
//                 console.log('Updated region', region)
//             })

//             // Loop a region on click
//             let loop = true
//             // Toggle looping with a checkbox
//             document.querySelector('#loop').onclick = (e) => {
//                 loop = e.target.checked
//             }

//             {
//                 let activeRegion = null
//                 wsRegions.on('region-in', (region) => {
//                     activeRegion = region
//                 })
//                 wsRegions.on('region-out', (region) => {
//                     if (activeRegion === region) {
//                         if (loop) {
//                             region.play()
//                         } else {
//                             activeRegion = null
//                         }
//                     }
//                 })
//                 wsRegions.on('region-clicked', (region, e) => {
//                     e.stopPropagation() // prevent triggering a click on the waveform
//                     activeRegion = region
//                     region.play()
//                     /* region.setOptions({
//                         color: randomColor()
//                     }) */
//                 })
//                 // Reset the active region when the user clicks anywhere in the waveform
//                 wavesurfer.on('interaction', () => {
//                     activeRegion = null
//                 })
//             }

//             $('#CreateModal').modal('show');
//         }

//         $('.changeUrlButton').on('click', () => {
//             //const newUrl = 'wav/PinkPanther60.wav'; // Replace with the new URL
//             const newUrl = 'wav/2023/10/01/q-4567-8888-20231001-141026-1696169425.161.wav';
//             // const newUrl = 'wav/'+$('#vioc').val();
//             // console.log('wav/' + $('#vioc').val());
//             console.log(newUrl);
//             initializeWaveSurfer(newUrl);
//         });
//         $('.vioc').on('click', function () {
//             const newUrl = 'wav/' + $('#vioc').val();
//             console.log('wav/' + $('#vioc').val());
//             console.log(newUrl);
//             initializeWaveSurfer(newUrl);
//         });

//         // $("#CreateModal").modal("show");
//     });

// }

import WaveSurfer from 'https://unpkg.com/wavesurfer.js@7/dist/wavesurfer.esm.js'
import Hover from 'https://unpkg.com/wavesurfer.js@7/dist/plugins/hover.esm.js'
import Minimap from 'https://unpkg.com/wavesurfer.js@7/dist/plugins/minimap.esm.js'
import TimelinePlugin from 'https://unpkg.com/wavesurfer.js@7/dist/plugins/timeline.esm.js'
import RegionsPlugin from 'https://unpkg.com/wavesurfer.js@7/dist/plugins/regions.esm.js'

let wavesurfer;

const random = (min, max) => Math.random() * (max - min) + min
const randomColor = () => `rgba(${random(0, 255)}, ${random(0, 255)}, ${random(0, 255)}, 0.5)`

const initializeWaveSurfer = (newUrl) => {
    // Create a second timeline
    const bottomTimline = TimelinePlugin.create({
        height: 15,
        timeInterval: 2,
        primaryLabelInterval: 10,
        style: {
            fontSize: '10px',
            color: '#000000',
        },
    })

    if (wavesurfer) {
        // Destroy the existing WaveSurfer instance to clear it
        wavesurfer.destroy();
    }

    wavesurfer = WaveSurfer.create({
        container: '#waveform',
        height: 200,
        audioRate: 1,
        splitChannels: false,
        normalize: false,
        waveColor: '#4F4A85',
        progressColor: '#383351',
        url: newUrl,
        cursorColor: '#b3aefb',
        cursorWidth: 1,
        barRadius: 1,
        barHeight: null,
        barAlign: "",
        minPxPerSec: 1,
        fillParent: true,
        plugins: [
            Hover.create({
                lineColor: '#ff0000',
                lineWidth: 2,
                labelBackground: '#555',
                labelColor: '#fff',
                labelSize: '11px',
            }),
            Minimap.create({
                height: 30,
                waveColor: '#ddd',
                progressColor: '#ff0000',
            }),
            bottomTimline
        ],
    })

    const wsRegions = wavesurfer.registerPlugin(RegionsPlugin.create())

    // Add event listeners and other functionality here...
}

const updateTimer = () => {
    const formattedTime = secondsToTimestamp(wavesurfer.getCurrentTime());
    $('#waveform-time-indicator .time').text(formattedTime);
};

const secondsToTimestamp = (seconds) => {
    // ... (existing code for this function)
};

// Add your other event listeners and functionality here...

// Function to change the audio URL
const changeAudioUrl = (newUrl) => {
    wavesurfer.load(newUrl);
};

// Function to open the modal and load the audio
function formModal(route) {
    $.get(route, function (res) {
        $("#modal_form_content").empty();
        $('#modal_form_content').html(res);
        const newUrl = 'wav/2023/10/01/q-4567-8888-20231001-141026-1696169425.161.wav';
        initializeWaveSurfer(newUrl);
        $("#CreateModal").modal("show");
    });
}

