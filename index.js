function confirmRequests(){
    openLoading()

    const reqs = [
        $('#request1').val() ? $('#request1').val() : 0,
        $('#request2').val() ? $('#request2').val() : 0,
        $('#request3').val() ? $('#request3').val() : 0,
        $('#request4').val() ? $('#request4').val() : 0,
        $('#request5').val() ? $('#request5').val() : 0,
        $('#request6').val() ? $('#request6').val() : 0,
        $('#request7').val() ? $('#request7').val() : 0,
        $('#request8').val() ? $('#request8').val() : 0,
        $('#request9').val() ? $('#request9').val() : 0,
        $('#request10').val() ? $('#request10').val() : 0,
        $('#request11').val() ? $('#request11').val() : 0,
        $('#request12').val() ? $('#request12').val() : 0,
        $('#request13').val() ? $('#request13').val() : 0,
        $('#request14').val() ? $('#request14').val() : 0,
        $('#request15').val() ? $('#request15').val() : 0,
        $('#request16').val() ? $('#request16').val() : 0,
        $('#request17').val() ? $('#request17').val() : 0,
        $('#request18').val() ? $('#request18').val() : 0,
        $('#request19').val() ? $('#request19').val() : 0,
        $('#request20').val() ? $('#request20').val() : 0,
    ];
    let concatReq = 0;

    for (let i = 0; i < reqs.length; i++) {
        if (reqs[i] != 0){
            if (concatReq != 0){
                concatReq = reqs[i] + ',' + concatReq;
            }else{
                concatReq = reqs[i];
            }
        }
    }
    let sector = $('#sectors').val()
    let user = $('#user').val()
    let userCode = $('#inputUserCode').val()

    const settings = {
        "url": "src/controllers/process.request.server.php",
        "method": "POST",
        "data": { 
            requests: reqs,
            requestsConcat: concatReq,
            sector,
            user, 
            userCode
        }
    };

    $.ajax(settings).done(function (response) {
        console.log(response);
        if (response == 1){
            closeLoading()
            $("#btn_confirm").hide()
            $("#labelReturnConfirmSuccess").attr('hidden', false)
            setTimeout(function(){
                location.reload()
            }, 3000)
        }else{
            closeLoading()
            $("#btn_confirm").hide()
            $("#labelReturnConfirmDanger").attr('hidden', false)
            setTimeout(function(){
                location.reload()
            }, 3000)
        }
        
    });

    
}

function openLoading(){
    $('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
}

function closeLoading(){
    setTimeout(function(){
        $( "#loadingDiv" ).fadeOut(500, function() {
            $( "#loadingDiv" ).remove(); 
        }); 
      }, 500);  
}

$(document).ready(function(){
   //cont = 1;
    var resultCollector = Quagga.ResultCollector.create({
        capture: true,
        capacity: 20,
        blacklist: [{
            code: "WIWV8ETQZ1", format: "code_93"
        }, {
            code: "EH3C-%GU23RK3", format: "code_93"
        }, {
            code: "O308SIHQOXN5SA/PJ", format: "code_93"
        }, {
            code: "DG7Q$TV8JQ/EN", format: "code_93"
        }, {
            code: "VOFD1DB5A.1F6QU", format: "code_93"
        }, {
            code: "4SO64P4X8 U4YUU1T-", format: "code_93"
        }],
        filter: function(codeResult) {
            // only store results which match this constraint
            // e.g.: codeResult
            return true;
        }
    });
     App = {
        init: function() {
            var self = this;

            Quagga.init(this.state, function(err) {
                if (err) {
                    return self.handleError(err);
                }
                //Quagga.registerResultCollector(resultCollector);
                
                App.attachListeners();
                App.checkCapabilities();
            });
        },
        handleError: function(err) {
            console.log(err);
        },
        checkCapabilities: function() {
            var track = Quagga.CameraAccess.getActiveTrack();
            var capabilities = {};
            if (typeof track.getCapabilities === 'function') {
                capabilities = track.getCapabilities();
            }
            this.applySettingsVisibility('zoom', capabilities.zoom);
            this.applySettingsVisibility('torch', capabilities.torch);
        },
        updateOptionsForMediaRange: function(node, range) {
            console.log('updateOptionsForMediaRange', node, range);
            var NUM_STEPS = 6;
            var stepSize = (range.max - range.min) / NUM_STEPS;
            var option;
            var value;
            while (node.firstChild) {
                node.removeChild(node.firstChild);
            }
            for (var i = 0; i <= NUM_STEPS; i++) {
                value = range.min + (stepSize * i);
                option = document.createElement('option');
                option.value = value;
                option.innerHTML = value;
                node.appendChild(option);
            }
        },
        applySettingsVisibility: function(setting, capability) {
            // depending on type of capability
            if (typeof capability === 'boolean') {
                var node = document.querySelector('input[name="settings_' + setting + '"]');
                if (node) {
                    node.parentNode.style.display = capability ? 'block' : 'none';
                }
                return;
            }
            if (window.MediaSettingsRange && capability instanceof window.MediaSettingsRange) {
                var node = document.querySelector('select[name="settings_' + setting + '"]');
                if (node) {
                    this.updateOptionsForMediaRange(node, capability);
                    node.parentNode.style.display = 'block';
                }
                return;
            }
        },
        initCameraSelection: function(){
            var streamLabel = Quagga.CameraAccess.getActiveStreamLabel();

            return Quagga.CameraAccess.enumerateVideoDevices()
            .then(function(devices) {
                function pruneText(text) {
                    return text.length > 30 ? text.substr(0, 30) : text;
                }
                var $deviceSelection = document.getElementById("deviceSelection");
                while ($deviceSelection.firstChild) {
                    $deviceSelection.removeChild($deviceSelection.firstChild);
                }
                devices.forEach(function(device) {
                    var $option = document.createElement("option");
                    $option.value = device.deviceId || device.id;
                    $option.appendChild(document.createTextNode(pruneText(device.label || device.deviceId || device.id)));
                    $option.selected = streamLabel === device.label;
                    $deviceSelection.appendChild($option);
                });
            });
        },
        attachListeners: function() {
            var self = this;

            self.initCameraSelection();
            $(".controls").on("click", "button.stop", function(e) {
                e.preventDefault();
                Quagga.stop();
                self._printCollectedResults();
            });

            $(".controls .reader-config-group").on("change", "input, select", function(e) {
                e.preventDefault();
                var $target = $(e.target),
                    value = $target.attr("type") === "checkbox" ? $target.prop("checked") : $target.val(),
                    name = $target.attr("name"),
                    state = self._convertNameToState(name);

                console.log("Value of "+ state + " changed to " + value);
                self.setState(state, value);
            });
        },
        _printCollectedResults: function() {
            var results = resultCollector.getResults(),
                $ul = $("#result_strip ul.collector");

            results.forEach(function(result) {
                var $li = $('<li><div class="thumbnail"><div class="imgWrapper"><img /></div><div class="caption"><h4 class="code"></h4></div></div></li>');

                $li.find("img").attr("src", result.frame);
                $li.find("h4.code").html(result.codeResult.code + " (" + result.codeResult.format + ")");
                $ul.prepend($li);

                return;
            });
        },
        _accessByPath: function(obj, path, val) {
            var parts = path.split('.'),
                depth = parts.length,
                setter = (typeof val !== "undefined") ? true : false;

            return parts.reduce(function(o, key, i) {
                if (setter && (i + 1) === depth) {
                    if (typeof o[key] === "object" && typeof val === "object") {
                        Object.assign(o[key], val);
                    } else {
                        o[key] = val;
                    }
                }
                return key in o ? o[key] : {};
            }, obj);
        },
        _convertNameToState: function(name) {
            return name.replace("_", ".").split("-").reduce(function(result, value) {
                return result + value.charAt(0).toUpperCase() + value.substring(1);
            });
        },
        detachListeners: function() {
            $(".controls").off("click", "button.stop");
            $(".controls .reader-config-group").off("change", "input, select");
        },
        applySetting: function(setting, value) {
            var track = Quagga.CameraAccess.getActiveTrack();
            if (track && typeof track.getCapabilities === 'function') {
                switch (setting) {
                case 'zoom':
                    return track.applyConstraints({advanced: [{zoom: parseFloat(value)}]});
                case 'torch':
                    return track.applyConstraints({advanced: [{torch: !!value}]});
                }
            }
        },
        setState: function(path, value) {
            var self = this;

            if (typeof self._accessByPath(self.inputMapper, path) === "function") {
                value = self._accessByPath(self.inputMapper, path)(value);
            }

            if (path.startsWith('settings.')) {
                var setting = path.substring(9);
                return self.applySetting(setting, value);
            }
            self._accessByPath(self.state, path, value);

            console.log(JSON.stringify(self.state));
            App.detachListeners();
            Quagga.stop();
            App.init();
        },
        inputMapper: {
            inputStream: {
                constraints: function(value){
                    if (/^(\d+)x(\d+)$/.test(value)) {
                        //var values = value.split('x');
                        return {
                            width: {min: 640},
                            height: {min: 320}
                        };
                    }
                    return {
                        deviceId: value
                    };
                }
            },
            numOfWorkers: function(value) {
                return parseInt(value);
            },
            decoder: {
                readers: function(value) {
                    if (value === 'ean_extended') {
                        return [{
                            format: "ean_reader",
                            config: {
                                supplements: [
                                    'ean_5_reader', 'ean_2_reader'
                                ]
                            }
                        }];
                    }
                    return [{
                        format: value + "_reader",
                        config: {}
                    }];
                }
            }
        },
        state: {
            inputStream: {
                type : "LiveStream",
                constraints: {
                    width : 640,
                    height: 320,
                    facingMode: "environment",
                    aspectRatio: {min: 1, max: 2}
                }
            },
            locator: {
                patchSize: "medium",
                halfSample: true
            },
            numOfWorkers: 2,
            frequency: 10,
            decoder: {
                readers : [{
                    format: "code_128_reader",
                    config: {}
                }],
                multiple: false
            },
            locate: true
        },
        lastResult : null
    };

    App.init();
    getSectors();

})

function consoleScreen(data){
    $(`#logs`).append(`<br/> ${data}`)
}

function openCameraTest(par) {
    let op = par;
    let cont = parseInt($('#cont').val());
    
    let svgBtnSuccess = `<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z" fill="green"/></svg>`;

    let svgBtnError = `<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM232 152C232 138.8 242.8 128 256 128s24 10.75 24 24v128c0 13.25-10.75 24-24 24S232 293.3 232 280V152zM256 400c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 385.9 273.4 400 256 400z" fill="red"/></svg>`;

    let svgBarCode = `<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M22 22h-20c-1.104 0-2-.896-2-2v-16c0-1.104.896-2 2-2h20c1.104 0 2 .896 2 2v16c0 1.104-.896 2-2 2zm0-18h-20v16h20v-16zm-2 14h-1v-12h1v12zm-5 0h-1v-12h1v12zm-2 0h-1v-12h1v12zm-2 0h-2v-12h2v12zm-3 0h-1v-12h1v12zm10 0h-2v-12h2v12zm-12 0h-2v-12h2v12z"/></svg>`;

    var code = 40630155
    //openLoading()
    
    if (op == 'request'){
        
        let sector = $('#sectors').val()
        sector = 169

        if (1 == 1) {
            App.lastResult = code;

            openLoading()
                
            const settings = {
                "url": "src/rules/validate.request.server.rule.php",
                "method": "POST",
                "data": { 
                    request: code,
                    sector
                }
            };

            $.ajax(settings).done(function (response) {

                if (response == 1){


                    $("#exampleModal #close").click()

                    document.querySelector(`#request${cont}`).value = code   

                    cont = cont + 1
                    let newRequest = `
                    <div class="row mt-2">
                    <div class="col-9">
                        <input type="text" disabled class="form-control"  id="request${cont}"/>
                    </div>
                    <div class="col-3">
                        <button href="#" style="border:1px solid black;" onclick="openCameraTest('request')" class="btn form-control" id="btnBarCode${cont}" >
                        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M22 22h-20c-1.104 0-2-.896-2-2v-16c0-1.104.896-2 2-2h20c1.104 0 2 .896 2 2v16c0 1.104-.896 2-2 2zm0-18h-20v16h20v-16zm-2 14h-1v-12h1v12zm-5 0h-1v-12h1v12zm-2 0h-1v-12h1v12zm-2 0h-2v-12h2v12zm-3 0h-1v-12h1v12zm10 0h-2v-12h2v12zm-12 0h-2v-12h2v12z"/></svg>
                        </button>
                    </div>
                    </div>
                    `;

                    
                    $(`#requests`).append(newRequest);
                    $(`#btnBarCode${cont-1}`).attr('disabled', 'disabled');
                    $(`#btnBarCode${cont}`).addClass(`animate__animated animate__fadeIn`);
                    $(`#request${cont}`).addClass(`animate__animated animate__fadeIn`);
                    $(`#btnBarCode${cont-1}`).html(svgBtnSuccess);

                    //Quagga.stop();  
                    $('#cont').val(cont); 

                    $("#exampleModal #close").click()
                    closeLoading()
                    return; 

                }else{
                    closeLoading()
                    $("#exampleModal #close").click()
                    

                    $(`#btnBarCode${cont}`).html(svgBtnError);
                    $(`#btnBarCode${cont}`).addClass(`animate__animated animate__flash`);

                    setTimeout(function(){
                        $(`#btnBarCode${cont}`).html(svgBarCode);
                        $(`#btnBarCode${cont}`).removeClass(`animate__animated animate__flash`);
                    }, 2000)

                    //Quagga.stop();   
                    return; 

                
                }

            }).catch(() => {
                return false;
            });

        }
    }
};

function openCamera(par) {
    let op = par;
    let cont = parseInt($('#cont').val());
    
    let svgBtnSuccess = `<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z" fill="green"/></svg>`;

    let svgBtnError = `<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM232 152C232 138.8 242.8 128 256 128s24 10.75 24 24v128c0 13.25-10.75 24-24 24S232 293.3 232 280V152zM256 400c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 385.9 273.4 400 256 400z" fill="red"/></svg>`;

    let svgBarCode = `<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M22 22h-20c-1.104 0-2-.896-2-2v-16c0-1.104.896-2 2-2h20c1.104 0 2 .896 2 2v16c0 1.104-.896 2-2 2zm0-18h-20v16h20v-16zm-2 14h-1v-12h1v12zm-5 0h-1v-12h1v12zm-2 0h-1v-12h1v12zm-2 0h-2v-12h2v12zm-3 0h-1v-12h1v12zm10 0h-2v-12h2v12zm-12 0h-2v-12h2v12z"/></svg>`;

    Quagga.start();
    Quagga.onDetected(function(result) {
    var code = result.codeResult.code;
    
    if (op == 'request'){
        
        let sector = $('#sectors').val()

        if (App.lastResult !== code) {
            App.lastResult = code;

            Quagga.offDetected(); 

            openLoading()
                
            const settings = {
                "url": "src/rules/validate.request.server.rule.php",
                "method": "POST",
                "data": { 
                    request: code,
                    sector
                }
            };

            $.ajax(settings).done(function (response) {

                if (response == 1){


                    $("#exampleModal #close").click()

                    document.querySelector(`#request${cont}`).value = code   

                    cont = cont + 1
                    let newRequest = `
                    <div class="row mt-2">
                    <div class="col-9">
                        <input type="text" disabled class="form-control"  id="request${cont}"/>
                    </div>
                    <div class="col-3">
                        <button href="#" style="border:1px solid black;" onclick="openCamera('request')" class="btn form-control" id="btnBarCode${cont}" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M22 22h-20c-1.104 0-2-.896-2-2v-16c0-1.104.896-2 2-2h20c1.104 0 2 .896 2 2v16c0 1.104-.896 2-2 2zm0-18h-20v16h20v-16zm-2 14h-1v-12h1v12zm-5 0h-1v-12h1v12zm-2 0h-1v-12h1v12zm-2 0h-2v-12h2v12zm-3 0h-1v-12h1v12zm10 0h-2v-12h2v12zm-12 0h-2v-12h2v12z"/></svg>
                        </button>
                    </div>
                    </div>
                    `;

                    
                    $(`#requests`).append(newRequest);
                    $(`#btnBarCode${cont-1}`).attr('disabled', 'disabled');
                    $(`#btnBarCode${cont}`).addClass(`animate__animated animate__fadeIn`);
                    $(`#request${cont}`).addClass(`animate__animated animate__fadeIn`);
                    $(`#btnBarCode${cont-1}`).html(svgBtnSuccess);

                    //Quagga.stop();  
                    $('#cont').val(cont); 

                    $("#exampleModal #close").click()
                    closeLoading()
                    return; 

                }else{
                    closeLoading()
                    $("#exampleModal #close").click()
                    

                    $(`#btnBarCode${cont}`).html(svgBtnError);
                    $(`#btnBarCode${cont}`).addClass(`animate__animated animate__flash`);

                    setTimeout(function(){
                        $(`#btnBarCode${cont}`).html(svgBarCode);
                        $(`#btnBarCode${cont}`).removeClass(`animate__animated animate__flash`);
                    }, 2000)

                    //Quagga.stop();   
                    return; 

                
                }

            }).catch(() => {
                return false;
            });

        }
    }

    });
};

function getSectors(){
    const settings = {
        "url": "src/rules/sectors.rule.php",
        "method": "POST",
    };

    $.ajax(settings).done(function (response) {
        response = JSON.parse(response);
        response.forEach(element => {
            $('#sectors').append(`
                <option value="${element.code}">${element.description}</option>
            `);
        });

       
    });



    
}

