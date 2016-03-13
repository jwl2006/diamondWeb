/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



            /* global boddie */

var bits = 80; // how many bits
            var speed = 66; // how fast - smaller is faster
            var colours = new Array("#03f", "#f03", "#0e0", "#93f", "#0cf", "#f93", "#f0c"); 
            //                     blue    red     green   purple  cyan    orange  pink
            var stars = new Array();
            var intensity = new Array();
            var Xpos = new Array();
            var Ypos = new Array();
            var dY = new Array();
            var dX = new Array();
            var decay = new Array();
            
            boddie = document.createElement("div");
            boddie.style.position = "absolute";
            boddie.style.top = "0px";
            boddie.style.left = "0px";
            boddie.style.overflow = "visible";
            boddie.style.width = "1px";
            boddie.style.height = "1px";
            boddie.style.backgroundColor = "transparent";
            document.body.appendChild(boddie);
            
            function write_fire(xpos, ypos) {
              for (var i = 0; i < bits; i++) {
                stars[i] = createDiv('*', 13);
                stars[i].style.color = colours[i % colours.length];
                stars[i].style.visibility="visible";
                boddie.appendChild(stars[i]);
                intensity[i] = 5 + Math.random() * 4;
                Xpos[i] = xpos; 
                Ypos[i] = ypos;
                dY[i] = (Math.random() - 0.5) * intensity[i];
                dX[i] = (Math.random() - 0.5) * (intensity[i] - Math.abs(dY[i])) * 1.25;
                decay[i] = 16 + Math.floor(Math.random() * 16);
              }
              bang();
            }
            function bang(){
                var i, Z, A=0;
                for (i = 0; i < bits; ++i){
                    Z = stars[i].style;
                    Z.left = Xpos[i] + "px";
                    Z.top = Ypos[i] + "px";
                    if (decay[i]) decay[i]--;
                    else A++;
                    if (decay[i] == 15) Z.fontSize="7px";
                    else if (decay[i] == 7) Z.fontSize="2px";
                    else if (decay[i] == 1) Z.visibility="hidden";
                    if (decay[i] > 1 && Math.random()<.1) {
                       Z.visibility="hidden";
                       setTimeout('stars['+i+'].style.visibility="visible"', speed-1);
                    }
                    Xpos[i] += dX[i];
                    Ypos[i] +=(dY[i] +=1.25/intensity[i]); 
                }
                if (A!=bits) setTimeout("bang()", speed);
            }
            function createDiv(char, size) {
              var div=document.createElement("div");
              div.style.font=size+"px monospace";
              div.style.position="absolute";
              div.style.backgroundColor="transparent";
              div.appendChild(document.createTextNode(char));
              return (div);
            }
