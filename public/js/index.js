const theme = {
    light: "#ff6d4d",
    primary: "#ff441a",
    dark: "#e62a00",
}

const classes = {
    add(el, ...args) {
        for (let c of args) {
            el.classList.add(c.trim());
        }
    },
    toggle(el, ...args) {
        for (let c of args) {
            el.classList.toggle(c.trim());
        }
    },
    remove(el, ...args) {
        for (let c of args) {
            el.classList.remove(c.trim());
        }
    }
}

class CSV {
    constructor(table, head = true, hide = []) {
        this.table = table;
        this.rows = [...table.querySelectorAll("tr")].map(el => el.cloneNode(true));

        if (!head) {
            this.rows.forEach(row => {
                if (row.parentElement.tagName == "THEAD")
                    row.remove();
            });
        }

        for (const index of hide) {
            this.rows.forEach(row => row.children[index].remove());
        }
    }

    convert() {
        const lines = [];
        const numCols = this._findLongestRowLength();

        for (const row of this.rows) {
            let line = "";

            for (let i = 0; i < numCols; i++) {
                if (row.children[i] !== undefined) {
                    line += CSV.parseCell(row.children[i]);
                }

                line += (i !== (numCols - 1)) ? "," : "";
            }

            lines.push(line);
        }

        return lines.join("\n");
    }

    _findLongestRowLength() {
        return this.rows.reduce((l, row) => row.childElementCount > l ? row.childElementCount : l, 0);
    }

    static parseCell(tableCell) {
        let parsedValue = tableCell.textContent.trim().replace(/\n\r|\n|\r/g, "").replace(/\s{2,}/g, " ");

        // Replace all double quotes with two double quotes
        parsedValue = parsedValue.replace(/"/g, `""`);

        // If value contains comma, new-line or double-quote, enclose in double quotes
        parsedValue = /[",\n]/.test(parsedValue) ? `"${parsedValue}"` : parsedValue;

        return parsedValue;
    }
}

function cleanInsert(target, element) {
    target.innerHTML = "";
    target.appendChild(element);
}

function makeNode(n, v) {
    n = document.createElementNS("http://www.w3.org/2000/svg", n);
    for (var p in v) {
        n.setAttributeNS(null, p.replace(/[A-Z]/g, function(m, p, o, s) {
            return "-" + m.toLowerCase();
        }), v[p]);
    }
    return n;
}

function draw(svg) {
    const self = {
        html: svg,
        layout: created => {
            const layout = {
                x: number => {
                    created.setAttribute("x", number);
                    return layout
                },
                y: number => {
                    created.setAttribute("y", number);
                    return layout
                },
                x1: number => {
                    created.setAttribute("x1", number);
                    return layout
                },
                y1: number => {
                    created.setAttribute("y1", number);
                    return layout
                },
                x2: number => {
                    created.setAttribute("x2", number);
                    return layout
                },
                y2: number => {
                    created.setAttribute("y2", number);
                    return layout
                },
                r: number => {
                    created.setAttribute("r", number);
                    return layout
                },
                cx: number => {
                    created.setAttribute("cx", number);
                    return layout
                },
                cy: number => {
                    created.setAttribute("cy", number);
                    return layout
                },
                points: points => {
                    created.setAttribute("points", points);
                    return layout
                },
                height: number => {
                    created.setAttribute("height", number + "px");
                    return layout
                },
                width: number => {
                    created.setAttribute("width", number + "px");
                    return layout
                },
                fill: color => {
                    created.setAttribute("fill", color);
                    return layout
                },
                stroke: color => {
                    created.setAttribute("stroke", color);
                    return layout
                },
                strokeWidth: number => {
                    created.setAttribute("stroke-width", number + "px");
                    return layout
                },
                text: text => {
                    created.innerHTML = text;
                    return layout
                },
                hover: callBack => {
                    created.addEventListener("pointerover", callBack);
                    return layout
                },
                attr: (Name, value = "") => {
                    created.setAttribute(Name, value);
                    return layout
                },
                append: shape => {
                    let create = created.appendChild(document.createElementNS("http://www.w3.org/2000/svg", shape)),
                        added = {
                            ...(self.layout(create)),
                            append: shape => {
                                return layout.append(shape)
                            }
                        };
                    return added
                },
                exit: _ => {
                    return self
                }
            }
            return layout
        },
        append: shape => {
            let created = self.html.appendChild(document.createElementNS("http://www.w3.org/2000/svg", shape));
            const layout = self.layout(created);
            return layout
        },
        viewBox: value => {
            self.html.setAttribute("viewBox", value);
            return self
        },
    }
    return self
}

const Program = {
    ucfirst(opts = {}) {
        const trigger = opts.trigger || "x-ucfirst",
            el = opts.el || null;

        const targets = document.querySelectorAll(`[${trigger}]`);
        if (el) targets = [...targets, ...(Array.isArray(el) ? el : [el])];
        if (!targets.length) return this;

        for (let i = 0; i < targets.length; i++) {
            const current = targets[i];
            const text = current.textContent.trim();

            current.textContent = text.length ? text[0].toUpperCase() + text.slice(1) : text;
            current.removeAttribute(trigger);
        }
        return this;
    },
    toggle(opts = {}) {
        const trigger = opts.trigger || "x-toggle",
            property = opts.property || "x-property";

        const triggers = document.querySelectorAll(`[${trigger}]`);
        if (!triggers.length) return this;

        for (let i = 0; i < triggers.length; i++) {
            const current = triggers[i];
            const map = {
                property: current.getAttribute(property).split(",") || [],
                trigger: current,
                targets: [],
            }

            const selector = map.trigger.getAttribute(trigger);
            if (!selector) return this;
            const targets = selector.split(",");

            for (let j = 0; j < targets.length; j++) {
                const current = targets[j].trim();
                const elements = document.querySelectorAll(current);
                if (!elements.length) continue;
                map.targets = [...map.targets, ...elements];
            }

            map.trigger.addEventListener("click", () => {
                for (let j = 0; j < map.targets.length; j++) {
                    const target = map.targets[j];
                    classes.toggle(target, ...map.property);
                }
            })

            map.trigger.removeAttribute(trigger);
            map.trigger.removeAttribute(property);
        }
        return this;
    },
    password(opts = {}) {
        const trigger = opts.trigger || "x-password",
            el = opts.el || null;

        var targets = document.querySelectorAll(`[${trigger}]`);
        if (el) targets = [...targets, ...(Array.isArray(el) ? el : [el])];
        if (!targets.length) return this;
        for (let i = 0; i < targets.length; i++) {
            const current = targets[i];
            current.type = 'password'
            const wrapper = document.createElement("div");
            wrapper.className = "relative";
            wrapper.innerHTML = /*html*/ `
                <button type="button"
                    class="absolute right-2 top-1/2 -translate-y-1/2 appearance-none rounded-md focus:outline-1 outline-primary">
                    <svg class="block w-6 h-6 text-gray-900 pointer-events-none"
                        fill="currentcolor" viewBox="0 0 48 48">
                        <path
                            d="M24 31.35q3.5 0 5.925-2.45T32.35 23q0-3.5-2.45-5.925T24 14.65q-3.5 0-5.925 2.45T15.65 23q0 3.5 2.45 5.925T24 31.35Zm0-3.55q-2 0-3.4-1.425T19.2 23q0-2 1.425-3.4T24 18.2q2 0 3.4 1.425T28.8 23q0 2-1.425 3.4T24 27.8ZM24 39q-7.2 0-13.05-3.95-5.85-3.95-9.1-10.4-.2-.3-.3-.75-.1-.45-.1-.9t.1-.9q.1-.45.3-.85 3.25-6.35 9.1-10.3Q16.8 7 24 7q7.2 0 13.05 3.95 5.85 3.95 9.1 10.3.2.4.3.85.1.45.1.85 0 .45-.1.925-.1.475-.3.775-3.25 6.45-9.1 10.4T24 39Z" />
                        <path class="hidden"
                            d="m39 33.7-7.4-7.4q.4-.6.575-1.55.175-.95.175-1.75 0-3.5-2.425-5.925T24 14.65q-.85 0-1.65.175-.8.175-1.65.575l-6.4-6.45q1.7-.7 4.525-1.325T24.25 7q6.8 0 12.775 3.775Q43 14.55 46.25 21.25q.15.4.225.85.075.45.075.9t-.075.925q-.075.475-.275.775-1.35 2.8-3.2 5.025-1.85 2.225-4 3.975Zm.1 10-6.45-6.25q-1.75.7-3.975 1.125Q26.45 39 24 39q-7.05 0-12.975-3.775T1.8 24.65q-.2-.35-.275-.775Q1.45 23.45 1.45 23t.1-.95q.1-.5.25-.85 1.05-2.15 2.675-4.25 1.625-2.1 3.675-4.1L3.3 7.95q-.5-.4-.5-1.125T3.3 5.6q.4-.45 1.15-.45.75 0 1.25.45l35.8 35.8q.45.5.375 1.175-.075.675-.375 1.075-.55.55-1.275.55-.725 0-1.125-.5ZM24 31.35q.6 0 1.225-.15.625-.15 1.025-.3L16 20.75q-.1.5-.225 1.1-.125.6-.125 1.15 0 3.55 2.45 5.95 2.45 2.4 5.9 2.4Zm4.1-8.6-3.6-3.6q1.35-.9 2.95.35t.65 3.25Z" />
                    </svg>
                </button>
            `
            current.className = "appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full pr-10 p-2 focus:outline-1 outline-primary";
            current.insertAdjacentElement('afterend', wrapper)
            wrapper.insertAdjacentElement('afterbegin', current);
            const button = wrapper.querySelector('button');
            const paths = wrapper.querySelectorAll('svg path');

            button.addEventListener("click", e => {
                current.type = current.type == "password" ? "text" : "password";
                classes.toggle(paths[0], "hidden");
                classes.toggle(paths[1], "hidden");
            });

            current.removeAttribute(trigger);
        }
        return this;
    },
    rich(opts = {}) {
        const trigger = opts.trigger || "x-rich",
            el = opts.el || null;
        var targets = document.querySelectorAll(`[${trigger}]`);
        if (el) targets = [...targets, ...(Array.isArray(el) ? el : [el])];
        if (!targets.length) return this;
        for (let i = 0; i < targets.length; i++) {
            const current = targets[i];
            classes.add(current, "hidden");
            const wrapper = document.createElement("div");
            wrapper.innerHTML = /*html*/ `
                <div class="w-full flex flex-wrap gap-4 p-2 border-b border-gray-300">
                    <div class="flex-1 flex flex-wrap gap-2">
                        <button title="bold" data-command="bold" class="flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M16.5 39.2q-1.9 0-3.225-1.35-1.325-1.35-1.325-3.25V13.35q0-1.9 1.325-3.25T16.5 8.75h9.85q3.65 0 6.225 2.425Q35.15 13.6 35.15 16.9q0 1.65-.9 3.45-.9 1.8-3.1 2.8v.35q2.7.95 3.825 3.125T36.1 30.7q0 3.1-2.55 5.8-2.55 2.7-6.9 2.7Zm1.05-4.55h8.1q1.2 0 2.9-1.025t1.7-3.425q0-2.35-1.65-3.375T25.7 25.8h-8.15Zm0-13.2h7.7q1.5 0 2.875-1.175T29.5 17.35q0-1.65-1.275-2.925T25.2 13.15h-7.65Z"/>
                            </svg>
                        </button>
                        <button title="italic" data-command="italic" class="flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M13.15 39.2q-1.2 0-2.025-.8t-.825-2q0-1.15.825-1.975.825-.825 2.025-.825h4.1L23.9 14h-4.85q-1.1 0-1.925-.775T16.3 11.25q0-1.15.825-1.975.825-.825 1.925-.825h15q1.15 0 1.975.825.825.825.825 1.975 0 1.2-.825 1.975Q35.2 14 34.05 14H30l-6.7 19.6h4.85q1.2 0 1.975.825.775.825.775 2.025t-.775 1.975q-.775.775-1.975.775Z"/>
                            </svg>
                        </button>
                        <button title="underline" data-command="underline" class="flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M11.5 43.7q-1 0-1.6-.625-.6-.625-.6-1.625 0-.95.6-1.6.6-.65 1.6-.65h25q1 0 1.625.65t.625 1.6q0 1-.625 1.625T36.5 43.7ZM24 35.8q-5.7 0-9.025-3.2t-3.325-8.75V8.7q0-1.15.75-1.925Q13.15 6 14.35 6q1.15 0 1.975.775.825.775.825 1.925v14.9q0 3.35 1.825 5.05 1.825 1.7 5.025 1.7t5.05-1.7q1.85-1.7 1.85-5.05V8.7q0-1.15.775-1.925Q32.45 6 33.65 6q1.15 0 1.975.775.825.775.825 1.925v15.15q0 5.55-3.375 8.75T24 35.8Z"/>
                            </svg>
                        </button>
                        <button title="strike through" data-command="strikeThrough" class="flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M25.5 41.3q-3.6 0-6.6-1.575-3-1.575-4.9-4.625-.5-.9-.1-1.85.4-.95 1.3-1.35.8-.3 1.625 0t1.425 1.05q1.2 1.8 3.225 2.775 2.025.975 3.975.975 2.5 0 3.75-1.275t1.25-3.375q0-1.25-.7-2.675-.7-1.425-2-2.675h5.4q1.1 1.25 1.55 2.625.45 1.375.45 2.725 0 4.15-2.6 6.7T25.5 41.3ZM5.55 23.75q-.8 0-1.275-.475Q3.8 22.8 3.8 22q0-.8.475-1.25.475-.45 1.275-.45H42.5q.75 0 1.225.45.475.45.475 1.25t-.475 1.275q-.475.475-1.225.475Zm8.65-6.45q-.1-.4-.15-.8-.05-.4-.05-.8-.1-4.45 2.725-6.8Q19.55 6.55 23.8 6.55q2.85 0 5.125 1T32.5 10.3q.8 1.05.45 2.125-.35 1.075-1.45 1.425-.7.3-1.5.075-.8-.225-1.6-1.025-.9-.85-2.1-1.3-1.2-.45-2.6-.45-2.3 0-3.675 1.25T18.7 15.8q0 .4.05.75t.15.75Z"/>
                            </svg>
                        </button>
                        <select title="font family" data-command="fontName" class="block text-gray-900 text-sm rounded-md focus:outline-1 outline-primary">
                            <option disabled selected hidden>Font family</option> 
                            <option value="Arial">Arial</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Tahoma">Tahoma</option>
                            <option value="Times New Roman">Roman</option>
                            <option value="Verdana">Verdana</option>
                            <option value="Impact">Impact</option>
                            <option value="Courier New">Courier</option>
                        </select>
                        <select title="font size" data-command="fontSize" class="block text-gray-900 text-sm rounded-md focus:outline-1 outline-primary">
                            <option disabled selected hidden>Font size</option> 
                            <option value="1">Size 1</option>
                            <option value="2">Size 2</option>
                            <option value="3">Size 3</option>
                            <option value="4">Size 4</option>
                            <option value="5">Size 5</option>
                            <option value="6">Size 6</option>
                            <option value="7">Size 7</option>
                        </select>
                        <select title="heading" data-command="formatBlock" class="block text-gray-900 text-sm rounded-md focus:outline-1 outline-primary">
                            <option disabled selected hidden>Heading</option> 
                            <option value="<h1>">h1</option>
                            <option value="<h2>">h2</option>
                            <option value="<h3>">h3</option>
                            <option value="<h4>">h4</option>
                            <option value="<h5>">h5</option>
                            <option value="<h6>">h6</option>
                        </select>
                        <label title="color" tabindex="0" for="forecolor" class="relative flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <input id="forecolor" type="color" data-command="foreColor" class="absolute inset-0 opacity-0" />
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 96 960 960">
                                <path d="M175 1052q-36 0-60-24.5T91 968q0-36 24.5-60.5T175 883h610q36 0 60 24.5t24 60.5q0 35-24.5 59.5T785 1052H175Zm90-298q-30 0-42.5-19t-.5-47l188-441q11-21 30.5-35t44.5-14q22 0 42.5 14t31.5 35l181 438q12 29-.5 49T694 754q-15 0-28.5-10.5T647 720l-43-104H353l-43 107q-5 11-17.5 21T265 754Zm115-211h199l-97-255h-4l-98 255Z"/>   
                            </svg>
                        </label>
                        <label title="background" tabindex="0" for="backColor" class="relative flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <input id="backColor" type="color" data-command="backColor" class="absolute inset-0 opacity-0" />
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 96 960 960">
                                <path d="M415.029 792q-18.588 0-36.955-8-18.367-8-32.074-21L181 595q-15.043-13.744-22.022-32.226Q152 544.291 152 523.966q0-19.326 6.978-38.096Q165.957 467.099 181 452l178-178-89-89q-12-11.5-12-29.25t12-29.141Q281 116 298 116t28 12l326 324q12.435 14.999 20.217 33.635Q680 504.271 680 523.815q0 20.545-7.783 39.003Q664.435 581.276 652 595L485 763q-14.761 14-32.572 21.5-17.81 7.5-37.399 7.5ZM417 332 233 514h.5-.5 366L417 332Zm348.288 473Q733 805 710.5 782.548T688 726.376q0-17.724 9-38.55Q706 667 722 643q8-15 19.5-30t24.5-30q13 15 25.31 30.158Q803.621 628.316 812 643q15 24 24 44.885 9 20.885 9 38.409 0 33.406-23.712 56.056-23.713 22.65-56 22.65ZM145 1053q-26.338 0-45.169-18.26Q81 1016.48 81 989.239 81 963 99.831 945q18.831-18 45.169-18h671q25.925 0 44.463 18.053 18.537 18.053 18.537 44 0 26.947-18.537 45.447Q841.925 1053 816 1053H145Z"/>   
                            </svg>
                        </label>
                        <button title="justify left" data-command="justifyLeft" class="flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M5.25 35.65q-.95 0-1.625-.65t-.675-1.6q0-1 .675-1.65.675-.65 1.625-.65h24.3q1 0 1.625.675t.625 1.575q0 1.05-.625 1.675t-1.625.625Zm0-18.75q-.95 0-1.625-.675T2.95 14.6q0-1 .675-1.65.675-.65 1.625-.65h24.3q1 0 1.625.65t.625 1.65q0 1-.625 1.65-.625.65-1.625.65Zm0 9.4q-.95 0-1.625-.675T2.95 24q0-1 .675-1.625t1.625-.625H42.8q.9 0 1.575.625.675.625.675 1.625t-.675 1.65q-.675.65-1.575.65Zm0 18.75q-.95 0-1.625-.675T2.95 42.75q0-1 .675-1.65.675-.65 1.625-.65H42.8q.9 0 1.575.65.675.65.675 1.65 0 1-.675 1.65-.675.65-1.575.65Zm0-37.55q-.95 0-1.625-.65t-.675-1.6q0-1 .675-1.65.675-.65 1.625-.65H42.8q.9 0 1.575.675.675.675.675 1.575 0 1.05-.675 1.675T42.8 7.5Z"/>
                            </svg>
                        </button>
                        <button title="justify center" data-command="justifyCenter" class="flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M5.25 45.05q-.95 0-1.625-.675T2.95 42.75q0-1 .675-1.65.675-.65 1.625-.65H42.8q.9 0 1.575.65.675.65.675 1.65 0 1-.675 1.65-.675.65-1.575.65Zm8.2-9.4q-.95 0-1.625-.65t-.675-1.6q0-1 .675-1.65.675-.65 1.625-.65h21.2q.9 0 1.575.675.675.675.675 1.575 0 1.05-.675 1.675t-1.575.625Zm-8.2-9.35q-.95 0-1.625-.675T2.95 24q0-1 .675-1.625t1.625-.625H42.8q.9 0 1.575.625.675.625.675 1.625t-.675 1.65q-.675.65-1.575.65Zm8.2-9.4q-.95 0-1.625-.675T11.15 14.6q0-1 .675-1.65.675-.65 1.625-.65h21.2q.9 0 1.575.65.675.65.675 1.65 0 1-.675 1.65-.675.65-1.575.65Zm-8.2-9.4q-.95 0-1.625-.65t-.675-1.6q0-1 .675-1.65.675-.65 1.625-.65H42.8q.9 0 1.575.675.675.675.675 1.575 0 1.05-.675 1.675T42.8 7.5Z"/>
                            </svg>
                        </button>
                        <button title="justify right" data-command="justifyRight" class="flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M5.25 45.05q-.95 0-1.625-.675T2.95 42.75q0-1 .675-1.65.675-.65 1.625-.65H42.8q.9 0 1.575.65.675.65.675 1.65 0 1-.675 1.65-.675.65-1.575.65Zm13.35-9.4q-1.1 0-1.725-.65t-.625-1.6q0-1 .625-1.65.625-.65 1.725-.65h24.2q.9 0 1.575.675.675.675.675 1.575 0 1.05-.675 1.675t-1.575.625ZM5.25 26.3q-.95 0-1.625-.675T2.95 24q0-1 .675-1.625t1.625-.625H42.8q.9 0 1.575.625.675.625.675 1.625t-.675 1.65q-.675.65-1.575.65Zm13.35-9.4q-1.1 0-1.725-.675T16.25 14.6q0-1 .625-1.65.625-.65 1.725-.65h24.2q.9 0 1.575.65.675.65.675 1.65 0 1-.675 1.65-.675.65-1.575.65ZM5.25 7.5q-.95 0-1.625-.65t-.675-1.6q0-1 .675-1.65.675-.65 1.625-.65H42.8q.9 0 1.575.675.675.675.675 1.575 0 1.05-.675 1.675T42.8 7.5Z"/>
                            </svg>
                        </button>
                        <button title="paragraph" data-command="insertParagraph" class="flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M20.05 40.75q-1 0-1.65-.675-.65-.675-.65-1.575V27.7h-1q-4-.25-6.75-3.175T7.25 17.5q0-4.3 3-7.3t7.3-3h17.3q1 0 1.625.675T37.1 9.5q0 .95-.65 1.6-.65.65-1.6.65H32.6V38.5q0 .9-.65 1.575-.65.675-1.6.675-1 0-1.65-.675-.65-.675-.65-1.575V11.75h-5.7V38.5q0 .9-.675 1.575-.675.675-1.625.675Z"/>
                            </svg>
                        </button>
                        <button title="unordered list" data-command="insertUnorderedList" class="flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M7.7 27.25q-1.35 0-2.325-.925Q4.4 25.4 4.4 24q0-1.35 1-2.325 1-.975 2.35-.975 1.3 0 2.25 1t.95 2.3q0 1.35-.95 2.3-.95.95-2.3.95Zm0-12.5q-1.4 0-2.35-.925Q4.4 12.9 4.4 11.5q0-1.35.975-2.3.975-.95 2.325-.95t2.3.95q.95.95.95 2.3 0 1.4-.95 2.325-.95.925-2.3.925Zm0 25q-1.35 0-2.325-.95-.975-.95-.975-2.3 0-1.35 1-2.325 1-.975 2.35-.975 1.3 0 2.25.975t.95 2.325q0 1.4-.95 2.325-.95.925-2.3.925Zm10.7-1q-1.05 0-1.675-.65t-.625-1.6q0-1 .625-1.65.625-.65 1.675-.65h22.95q.9 0 1.6.675.7.675.7 1.575 0 1.05-.7 1.675t-1.6.625Zm0-12.45q-1.05 0-1.675-.675T16.1 24q0-1 .625-1.625t1.675-.625h22.95q.9 0 1.6.625.7.625.7 1.625t-.7 1.65q-.7.65-1.6.65Zm0-12.5q-1.05 0-1.675-.65t-.625-1.6q0-1 .625-1.65.625-.65 1.675-.65h22.95q.9 0 1.6.675.7.675.7 1.575 0 1.05-.7 1.675t-1.6.625Z"/>
                            </svg>
                        </button>
                        <button title="ordered list" data-command="insertOrderedList" class="flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M6.45 39.95q-.35 0-.6-.25t-.25-.6q0-.35.25-.575.25-.225.6-.225H9.8v-1.35H8.55q-.35 0-.6-.25t-.25-.6q0-.3.25-.55.25-.25.6-.25H9.8v-1.35H6.45q-.35 0-.6-.25t-.25-.6q0-.3.25-.55.25-.25.6-.25h4.75q.3 0 .6.25t.3.55v6q0 .35-.3.6t-.6.25ZM8.8 15.8q-.45 0-.775-.325T7.7 14.65v-4.4h-.95q-.5 0-.825-.3-.325-.3-.325-.75 0-.5.325-.825.325-.325.825-.325h2.4q.3 0 .575.25.275.25.275.55v5.8q0 .5-.375.825-.375.325-.825.325ZM6 27.85q-.35 0-.6-.275t-.25-.625v-.35q0-.05.2-.6l3.1-3.6H6.3q-.45 0-.8-.325-.35-.325-.35-.775t.35-.8q.35-.35.8-.35h4.9q.3 0 .6.275t.3.575v.4l-.25.55-3.1 3.65h2.15q.45 0 .825.325.375.325.375.775t-.375.8q-.375.35-.825.35ZM18.1 38.3q-1.05 0-1.675-.65t-.625-1.6q0-1 .625-1.65.625-.65 1.675-.65h22.5q.95 0 1.625.675T42.9 36q0 1.05-.675 1.675T40.6 38.3Zm0-12.1q-1.05 0-1.675-.675T15.8 23.9q0-1 .625-1.625t1.675-.625h22.5q.95 0 1.625.625T42.9 23.9q0 1-.675 1.65-.675.65-1.625.65Zm0-12.15q-1.05 0-1.675-.65t-.625-1.6q0-1 .625-1.65.625-.65 1.675-.65h22.5q.95 0 1.625.675t.675 1.575q0 1.05-.675 1.675t-1.625.625Z"/>
                            </svg>
                        </button>
                        <button title="indent" data-command="indent" class="flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M5.25 45.05q-.95 0-1.625-.675T2.95 42.75q0-1 .675-1.65.675-.65 1.625-.65H42.8q.9 0 1.575.65.675.65.675 1.65 0 1-.675 1.65-.675.65-1.575.65ZM2.95 29.9v-12q0-.75.675-1.05.675-.3 1.275.3L11.05 23q.25.3.25.85t-.25.85l-6.1 6q-.55.6-1.275.3-.725-.3-.725-1.1Zm20.4 5.75q-.95 0-1.625-.65t-.675-1.6q0-1 .675-1.65.675-.65 1.625-.65H42.8q.9 0 1.575.675.675.675.675 1.575 0 1.05-.675 1.675t-1.575.625ZM5.25 7.5q-.95 0-1.625-.65t-.675-1.6q0-1 .675-1.65.675-.65 1.625-.65H42.8q.9 0 1.575.675.675.675.675 1.575 0 1.05-.675 1.675T42.8 7.5Zm18.1 9.4q-.95 0-1.625-.675T21.05 14.6q0-1 .675-1.65.675-.65 1.625-.65H42.8q.9 0 1.575.65.675.65.675 1.65 0 1-.675 1.65-.675.65-1.575.65Zm0 9.4q-.95 0-1.625-.675T21.05 24q0-1 .675-1.625t1.625-.625H42.8q.9 0 1.575.625.675.625.675 1.625t-.675 1.65q-.675.65-1.575.65Z"/>
                            </svg>
                        </button>
                        <button title="outdent" data-command="outdent" class="flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M23.2 35.65q-1 0-1.675-.65t-.675-1.6q0-1 .675-1.65.675-.65 1.675-.65h19.45q.9 0 1.575.675.675.675.675 1.575 0 1.05-.675 1.675t-1.575.625ZM9.95 30.7l-6.1-6q-.25-.3-.25-.85t.25-.85L10 17.15q.6-.6 1.275-.3.675.3.675 1.05v12q0 .8-.725 1.1-.725.3-1.275-.3ZM5.4 45.05q-.95 0-1.625-.675T3.1 42.75q0-1 .675-1.65.675-.65 1.625-.65h37.25q.9 0 1.575.65.675.65.675 1.65 0 1-.675 1.65-.675.65-1.575.65Zm0-37.55q-.95 0-1.625-.65T3.1 5.25q0-1 .675-1.65.675-.65 1.625-.65h37.25q.9 0 1.575.675.675.675.675 1.575 0 1.05-.675 1.675T42.65 7.5Zm17.8 9.4q-1 0-1.675-.675T20.85 14.6q0-1 .675-1.65.675-.65 1.675-.65h19.45q.9 0 1.575.65.675.65.675 1.65 0 1-.675 1.65-.675.65-1.575.65Zm0 9.4q-1 0-1.675-.675T20.85 24q0-1 .675-1.625t1.675-.625h19.45q.9 0 1.575.625Q44.9 23 44.9 24t-.675 1.65q-.675.65-1.575.65Z"/>
                            </svg>
                        </button>
                        <button title="link" data-command="createLink" class="flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M14 35.1q-4.65 0-7.875-3.225Q2.9 28.65 2.9 24q0-4.7 3.225-7.925Q9.35 12.85 14 12.85h5.65q1 0 1.625.675T21.9 15.2q0 .95-.625 1.6-.625.65-1.625.65H14q-2.85 0-4.7 1.825T7.45 24q0 2.85 1.85 4.7t4.7 1.85h5.65q1 0 1.625.625T21.9 32.8q0 1-.625 1.65-.625.65-1.625.65Zm3.1-9.4q-.8 0-1.275-.45-.475-.45-.475-1.3 0-.75.475-1.225.475-.475 1.275-.475h13.75q.75 0 1.225.475.475.475.475 1.225 0 .85-.475 1.3-.475.45-1.225.45ZM45.15 24h-4.6q0-2.9-1.85-4.725-1.85-1.825-4.7-1.825h-5.55q-1.1 0-1.725-.675T26.1 15.15q0-1 .625-1.65.625-.65 1.725-.65H34q4.65 0 7.9 3.225T45.15 24ZM37.4 40.9q-.85 0-1.3-.45-.45-.45-.45-1.3v-3.9H31.7q-.8 0-1.275-.5-.475-.5-.475-1.2 0-.8.475-1.275.475-.475 1.275-.475h3.95v-4q0-.7.45-1.2t1.25-.5q.75 0 1.25.5t.5 1.2v4h4q.7 0 1.2.475t.5 1.225q0 .75-.5 1.25t-1.2.5h-4v3.9q0 .85-.5 1.3-.5.45-1.2.45Z"/>
                            </svg>
                        </button>
                        <button title="image" data-command="insertImage" class="flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M37.15 17q-.75 0-1.225-.45-.475-.45-.475-1.3V12.4h-2.9q-.75 0-1.225-.475-.475-.475-.475-1.275 0-.75.475-1.225.475-.475 1.225-.475h2.9v-2.9q0-.75.475-1.225.475-.475 1.225-.475.8 0 1.275.475.475.475.475 1.225v2.9h2.85q.75 0 1.25.475t.5 1.225q0 .8-.475 1.275-.475.475-1.275.475H38.9v2.85q0 .85-.475 1.3-.475.45-1.275.45ZM14.3 33.8h19.05q.75 0 1.075-.675.325-.675-.175-1.225l-4.75-6.35q-.3-.4-.925-.4t-.975.4l-5.3 7.1-3.8-4.95q-.35-.4-1-.425-.65-.025-.9.475l-3.3 4.15q-.45.55-.15 1.225.3.675 1.15.675Zm-5 9.3q-1.9 0-3.25-1.375T4.7 38.55V9.5q0-1.85 1.35-3.225T9.3 4.9h18.6v11.45q0 .65.525 1.175t1.125.525h.4v.35q0 .55.475 1.025.475.475.975.475h11.5v18.65q0 1.8-1.375 3.175Q40.15 43.1 38.35 43.1Z"/>
                            </svg>
                        </button>
                        <button title="table" data-command="createTable" class="flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                                <path d="M98-98v-765h765v765H98Zm91-530h582v-143H189v143Zm213 220h157v-163H402v163Zm0 219h157v-162H402v162ZM189-408h156v-163H189v163Zm427 0h155v-163H616v163ZM189-189h156v-162H189v162Zm427 0h155v-162H616v162Z"/>
                            </svg>
                        </button>
                        <button title="undo" data-command="undo" class="flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M15.75 38.75q-1.05 0-1.675-.65t-.625-1.65q0-1 .625-1.625t1.675-.625h12.9q3.15 0 5.45-2.1 2.3-2.1 2.3-5.2t-2.3-5.2q-2.3-2.1-5.45-2.1H15.8l3.3 3.25q.65.7.675 1.65.025.95-.675 1.55-.65.7-1.6.7-.95 0-1.6-.65l-7.15-7.2q-.35-.3-.525-.7-.175-.4-.175-.9 0-.45.175-.875t.525-.725l7.15-7.2q.65-.65 1.6-.65.95 0 1.6.65.65.7.65 1.625T19.1 11.7l-3.3 3.35h12.8q5 0 8.675 3.425Q40.95 21.9 40.95 26.9q0 4.95-3.675 8.4T28.6 38.75Z"/>
                            </svg>
                        </button>
                        <button title="redo" data-command="redo" class="flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M19.4 38.75q-4.95 0-8.65-3.45t-3.7-8.4q0-5 3.7-8.425 3.7-3.425 8.65-3.425h12.8l-3.25-3.35q-.7-.65-.7-1.575 0-.925.7-1.625.6-.65 1.55-.625.95.025 1.6.625l7.2 7.2q.3.3.525.75.225.45.225.9t-.225.85q-.225.4-.525.7l-7.2 7.2q-.65.65-1.6.65-.95 0-1.6-.65-.7-.7-.675-1.625.025-.925.725-1.625l3.25-3.25H19.35q-3.15 0-5.425 2.1t-2.275 5.2q0 3.1 2.275 5.2t5.425 2.1H32.3q1 0 1.65.625.65.625.65 1.625t-.65 1.65q-.65.65-1.65.65Z"/>
                            </svg>
                        </button>
                        <button title="clear" data-command="removeFormat" class="flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M9.5 43.05q-1.9 0-3.225-1.325Q4.95 40.4 4.95 38.5v-29q0-1.9 1.325-3.25T9.5 4.9h29q1.9 0 3.25 1.35T43.1 9.5v29q0 1.9-1.35 3.225-1.35 1.325-3.25 1.325Zm6.15-10.7q.45.55 1.15.55t1.2-.55l6-5.95 6.05 5.95q.45.55 1.15.55t1.2-.55q.5-.45.5-1.15t-.5-1.2l-6-6 6-6.05q.5-.45.5-1.15t-.5-1.2q-.5-.5-1.2-.5t-1.15.5l-6.05 6-6-6q-.5-.5-1.2-.5t-1.15.5q-.55.5-.55 1.2t.55 1.15L21.6 24l-5.95 6q-.55.5-.55 1.2t.55 1.15Z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="ml-auto" data-screen>
                        <button title="maximize" class="flex items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M11 39.3q-1 0-1.65-.65Q8.7 38 8.7 37v-7.25q0-.9.675-1.575Q10.05 27.5 11 27.5q1 0 1.625.675t.625 1.575v5h5q.9 0 1.575.625Q20.5 36 20.5 37t-.675 1.65q-.675.65-1.575.65Zm0-18.8q-1 0-1.65-.675-.65-.675-.65-1.625V11q0-1 .65-1.675T11 8.65h7.25q.9 0 1.575.7.675.7.675 1.6 0 1.05-.675 1.675t-1.575.625h-5v4.95q0 .95-.625 1.625T11 20.5Zm18.8 18.8q-.95 0-1.625-.675T27.5 37q0-1 .675-1.625t1.625-.625h4.95v-5q0-.9.65-1.575.65-.675 1.6-.675 1 0 1.675.675t.675 1.575V37q0 1-.675 1.65Q38 39.3 37 39.3Zm7.25-18.8q-1.05 0-1.675-.675T34.75 18.2v-4.95H29.8q-.95 0-1.625-.65T27.5 11q0-1 .675-1.675T29.8 8.65H37q1 0 1.675.675T39.35 11v7.2q0 .95-.7 1.625t-1.6.675Z"/>
                            </svg>
                        </button>
                        <button title="minimize" class="hidden items-center justify-center w-6 h-6 appearance-none text-gray-900 rounded-md outline-none focus:bg-gray-200 hover:bg-gray-200">
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M18.25 39.3q-1.05 0-1.675-.675T15.95 37v-4.95H11q-.95 0-1.625-.65T8.7 29.8q0-1 .675-1.65.675-.65 1.625-.65h7.2q1 0 1.65.65.65.65.65 1.65V37q0 .95-.675 1.625t-1.575.675ZM11 20.5q-.95 0-1.625-.675T8.7 18.2q0-1 .675-1.625T11 15.95h4.95v-5q0-.9.65-1.6.65-.7 1.6-.7 1 0 1.65.7.65.7.65 1.6v7.25q0 1-.65 1.65-.65.65-1.65.65Zm18.8 18.8q-1 0-1.65-.675-.65-.675-.65-1.625v-7.2q0-1 .65-1.65.65-.65 1.65-.65h7.25q.9 0 1.6.675.7.675.7 1.575 0 1.05-.7 1.675t-1.6.625h-5V37q0 .95-.625 1.625T29.8 39.3Zm0-18.8q-1 0-1.65-.65-.65-.65-.65-1.65v-7.25q0-.9.675-1.6.675-.7 1.625-.7 1 0 1.625.7t.625 1.6v5h5q.9 0 1.6.625.7.625.7 1.625t-.7 1.65q-.7.65-1.6.65Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="w-full h-48 rounded-md focus:outline-1 outline-primary overflow-y-auto resize-y p-4 revert"
                    placeholder="${current.getAttribute('placeholder') || ""}" contenteditable></div>
            `;
            wrapper.className = "bg-gray-50 border border-gray-300 rounded-md flex flex-col w-full";

            const container = wrapper.querySelector("[contenteditable]");
            const selects = wrapper.querySelectorAll("select");
            const inputs = wrapper.querySelectorAll("input");
            const buttons = wrapper.querySelectorAll("button");
            const screen = wrapper.querySelector("[data-screen]");
            screen.children[0].addEventListener('click', e => {
                wrapper.style = "width: 100vw; height: 100vh; position: fixed; top: 0; left: 0; z-index: 100;border-radius: 0";
                container.style = "flex: 1; background: #ffffff";
                document.body.style = "overflow: hidden";
                classes.toggle(screen.children[0], 'flex', "hidden");
                classes.toggle(screen.children[1], 'flex', "hidden");
            });

            screen.children[1].addEventListener('click', e => {
                wrapper.removeAttribute('style');
                container.removeAttribute('style');
                document.body.removeAttribute('style');
                classes.toggle(screen.children[0], 'flex', "hidden");
                classes.toggle(screen.children[1], 'flex', "hidden");
            });

            container.innerHTML = current.value;

            [...buttons].forEach(button => {
                button.addEventListener("click", (e) => {
                    e.preventDefault();
                    const command = e.target.dataset.command;
                    if (command == "createLink" || command == "insertImage") {
                        const url = prompt('Enter a URL:', 'http://');
                        document.execCommand(command, true, url);
                        return;
                    }
                    if (command == "createTable") {
                        var dimensions = prompt("Enter rows and columns (format 'rows:columns'):").split(":");
                        var rows = parseInt(dimensions[0]);
                        var cols = parseInt(dimensions[1]);
                        var table = document.createElement("table");
                        table.style = "border-collapse: collapse;";
                        for (var i = 0; i < rows; i++) {
                            var row = document.createElement("tr");
                            for (var j = 0; j < cols; j++) {
                                var cell = document.createElement("td");
                                cell.setAttribute("contenteditable", true);
                                cell.style = " border: 1px solid #1d1d1d; resize: both; overflow: auto; width: 60px; height: 20px;";
                                row.appendChild(cell);
                            }
                            table.appendChild(row);
                        }
                        var range = document.getSelection().getRangeAt(0);
                        range.insertNode(table);
                        return;
                    }
                    document.execCommand(command, false, null);
                });
            });

            [...selects].forEach(item => {
                item.addEventListener("input", (e) => {
                    const command = e.target.dataset.command;
                    const value = e.target.value;
                    document.execCommand('styleWithCSS', false, true);
                    document.execCommand(command, false, value);
                    item.selectedIndex = 0;
                });
            });

            [...inputs].forEach(item => {
                item.addEventListener("input", (e) => {
                    const command = e.target.dataset.command;
                    const value = e.target.value;
                    e.target.nextElementSibling.style.color = value;
                    document.execCommand('styleWithCSS', false, true);
                    document.execCommand(command, false, value);
                });
            });

            ['input'].forEach(event => {
                container.addEventListener(event, (e) => {
                    e.target.querySelectorAll("a").forEach(a => {
                        a.target = "_blank";
                    });
                    current.value = e.target.innerHTML;
                });
            });

            current.insertAdjacentElement("afterend", wrapper);
            current.removeAttribute(trigger);
        }
        return this;
    },
    select(opts = {}) {
        const trigger = opts.trigger || "x-select",
            el = opts.el || null,
            style = {
                color: "#FFFFFF",
                background: theme.primary,
                ...(opts.style || {})
            };

        var targets = document.querySelectorAll(`[${trigger}]`);
        if (el) targets = [...targets, ...(Array.isArray(el) ? el : [el])];
        if (!targets.length) return this;
        const toggle = function(el) {
            for (let item of el.list.children) {
                classes.remove(item, "hidden");
            }
            classes.toggle(el.container, "hidden", "flex");
            classes.remove(el.container, "lg:top-full", "lg:bottom-full");
            var _ = ((window.innerHeight - el.container.getBoundingClientRect().top) < el.container.clientHeight) ? "lg:bottom-full" : "lg:top-full";
            classes.add(el.container, _);
            el.container.scrollTop = 0;
            el.search.value = "";
            el.current.dispatchEvent(new CustomEvent('toggle', {
                bubbles: true,
            }))
        };
        const select = (el, i = 0) => {
            if (el.current.multiple) {
                if (el.target.hasAttribute("style")) {
                    const i = el.current.data.indexOf(el.option);
                    el.current.data.splice(i, 1)
                    el.target.removeAttribute("style");
                } else {
                    el.target.style.backgroundColor = style.background;
                    el.target.style.color = style.color;
                    !el.current.data.includes(el.option) && el.current.data.push(el.option);
                }
                el.input.innerHTML = el.current.data.map(e =>
                    `<span class="rounded-sm text-xs p-1" style="color: ${style.color};background: ${style.background}">${e.innerText.trim()}</span>`
                ).join("").trim();
                [...el.container.querySelectorAll("[x-select-input]")].forEach(e => e.remove());
                el.current.data.forEach(e => {
                    el.container.insertAdjacentHTML('beforeend', `<input x-select-input type="hidden" value="${e.value}" name="${el.current.xname}"/>`);
                });
            } else {
                el.current.selectedIndex = i;
                el.input.innerText = el.target.innerText.trim();
                for (let item of el.list.children) {
                    item.removeAttribute("style")
                }
                el.target.style.backgroundColor = style.background;
                el.target.style.color = style.color;
            }
        }
        const execute = (el) => {
            el.list.innerHTML = "";
            const options = [...el.current.querySelectorAll(":scope > option")].map(op => {
                op.padd = "";
                return op;
            });
            const groups = el.current.querySelectorAll("optgroup");
            if (groups.length) {
                for (let group of groups) {
                    options.push({
                            text: group.label,
                            head: true
                        },
                        ...[...group.querySelectorAll("option")].map(op => {
                            op.padd = "px-4 ";
                            return op;
                        }));
                }
            }
            if (options.length < 10) {
                el.search.remove();
            }
            for (let i = 0; i < options.length; i++) {
                const option = options[i];
                const index = [...el.current.options].indexOf(option);
                if (option.head) {
                    const item = document.createElement("li");
                    item.className = "text-gray-900 text-md px-2 py-1 font-black header";
                    item.innerHTML = option.text.trim();
                    el.list.append(item);
                } else {
                    if (!option.innerText.trim().length) continue;
                    const item = document.createElement("li");
                    item.className = option.padd + "text-gray-900 text-md p-2";
                    item.innerHTML = option.innerText.trim();
                    if (option.hasAttribute("selected") && !option.hasAttribute("disabled")) {
                        select({
                            list: el.list,
                            container: el.container,
                            current: el.current,
                            input: el.input,
                            target: item,
                            option: option
                        }, index);
                    }
                    if (option.hasAttribute("disabled")) {
                        item.className += " bg-gray-400";
                    } else {
                        item.className += " hover:bg-gray-900 hover:text-gray-900 hover:bg-opacity-10 cursor-pointer";
                        item.addEventListener("click", e => {
                            select({
                                list: el.list,
                                container: el.container,
                                current: el.current,
                                input: el.input,
                                target: item,
                                option: option,
                            }, index);
                            if (!el.current.multiple) {
                                toggle({
                                    container: el.container,
                                    current: el.current,
                                    search: el.search,
                                    list: el.list
                                });
                            }
                            el.current.dispatchEvent(new CustomEvent('select', {
                                bubbles: true,
                                detail: {
                                    item: item,
                                    index: index,
                                }
                            }))
                        });
                    }
                    el.list.append(item);
                }
            }
            el.current.dispatchEvent(new CustomEvent('load', {
                bubbles: true,
                detail: {
                    display: el.input,
                    search: el.search,
                }
            }))
        }

        for (let i = 0; i < targets.length; i++) {
            const current = targets[i];
            if (current.multiple) {
                current.data = [];
                current.xname = current.name;
                current.removeAttribute("name");
            }
            classes.add(current, "hidden");
            const wrapper = document.createElement("div");
            classes.add(wrapper, "relative");
            wrapper.innerHTML = /*html*/ `
                <div tabindex="0" class="w-full bg-gray-50 border border-gray-300 appearance-none text-gray-900 text-md rounded-md pr-10 p-2 focus:outline-1 outline-primary cursor-pointer">
                    <div class="w-full overflow-x-auto no-scrollbar">
                        <div contenteditable="false" placeholder="${current.getAttribute("placeholder") || ""}" class="w-max min-w-full flex gap-2 items-center"></div>
                    </div>
                </div>
                <svg class="block w-5 h-5 text-gray-900 pointer-events-none absolute right-2 top-1/2 -translate-y-1/2" fill="currentcolor" viewBox="0 0 48 48">
                    <path d="M24 31.8 10.9 18.7 14.2 15.45 24 25.35 33.85 15.5 37.1 18.75Z" />
                </svg>
                <div x-wrap class="fixed items-center justify-center p-4 inset-0 bg-gray-900 bg-opacity-40 z-20 lg:z-10 lg:absolute lg:top-full lg:inset-auto lg:p-0 lg:w-full lg:rounded-lg hidden">
                    <button class="block absolute top-2 right-4 text-white rounded-md focus:outline-1 focus:outline-1-2 outline-primary lg:hidden">
                        <svg class="block w-10 h-10 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                            <path
                                d="M12.45 37.65 10.35 35.55 21.9 24 10.35 12.45 12.45 10.35 24 21.9 35.55 10.35 37.65 12.45 26.1 24 37.65 35.55 35.55 37.65 24 26.1Z"
                            />
                        </svg>
                    </button>
                    <div class="w-full bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                        <div class="w-full overflow-auto max-h-100 lg:max-h-60">
                            <input id="search" type="search" placeholder="Search" class="appearance-none sticky top-0 bg-white border-b border-gray-300 text-gray-900 text-md block w-full p-2 outline-none" />
                            <ul class="w-full">
                            </ul>
                        </div>
                    </div>
                </div>
            `;

            const search = wrapper.querySelector('input[type="search"]');
            const display = wrapper.querySelector("[contenteditable]");
            const container = wrapper.querySelector("[x-wrap]");
            const button = wrapper.querySelector("button");
            const list = wrapper.querySelector("ul");
            container.removeAttribute("x-wrap");

            current.addEventListener("click", () => {
                display.click();
            })

            search.addEventListener("input", e => {
                const filter = e.target.value.toUpperCase().trim();
                for (let item of wrapper.querySelectorAll("li:not(.header)")) {
                    const phrase = item.innerText.toUpperCase().trim();
                    for (const niddle of filter.split(" ")) {
                        if (phrase.includes(niddle)) classes.remove(item, "hidden");
                        else classes.add(item, "hidden");
                    }
                }
            });

            for (let el of[display, button]) {
                el.addEventListener("click", (e) => {
                    e.preventDefault();
                    toggle({
                        container: container,
                        current: current,
                        search: search,
                        list: list,
                    })
                });
            }

            const config = {
                childList: true,
                subtree: true,
                attributes: true
            };

            const observer = new MutationObserver(() => {
                execute({
                    container: container,
                    search: search,
                    input: display,
                    current: current,
                    list: list,
                })
            });

            execute({
                container: container,
                search: search,
                input: display,
                current: current,
                list: list,
            });

            observer.observe(current, config);
            current.insertAdjacentElement("afterend", wrapper);
            current.removeAttribute(trigger);
        }
        return this;
    },
    table(opts = {}) {
        const trigger = opts.trigger || "x-table",
            name = opts.name || "x-name",
            hide = opts.hide || "x-hide",
            head = opts.head || "x-head",
            el = opts.el || null,
            style = {
                color: "#FFFFFF",
                background: theme.primary,
                header: theme.primary,
                text: "#FFFFFF",
                ...(opts.style || {})
            };

        var targets = document.querySelectorAll(`[${trigger}]`);
        if (el) targets = [...targets, ...(Array.isArray(el) ? el : [el])];
        if (!targets.length) return this;
        const chunck = function(items, n = 10) {
                return items.reduce((resultArray, item, index) => {
                    const chunkIndex = Math.floor(index / n)
                    if (!resultArray[chunkIndex]) {
                        resultArray[chunkIndex] = [];
                    }
                    resultArray[chunkIndex].push(item);
                    return resultArray;
                }, []);
            },
            populate = function(body, pages, index, len, wrap) {
                body.innerHTML = "";
                if (pages.length === 0)
                    body.innerHTML = "<tr><td class='py-2 text-center uppercase' colspan='" + len + "'>no records found</td></tr>"
                else
                    pages[index].forEach((row, i) => {
                        if (i % 2) row.className = "bg-gray-100";
                        else row.className = "bg-white";
                        body.append(row);
                    });
                wrap.scrollTop = 0;
            },
            select = (list, target) => {
                for (let item of list.children) {
                    item.removeAttribute("style")
                }
                target.style.backgroundColor = style.background;
                target.style.color = style.color;
            },
            buttons = function(container, pages, body, length, wrap) {
                container.innerHTML = ""
                pages.forEach((_, i) => {
                    const btn = document.createElement("button");
                    btn.className = "w-8 h-8 appearance-none text-sm flex items-center justify-center rounded-md font-black bg-gray-100 text-gray-900 hover:bg-gray-900 outline-none hover:text-gray-900 hover:bg-opacity-10 focus:bg-gray-900 focus:text-gray-900 focus:bg-opacity-10 cursor-pointer border border-gray-300";
                    btn.innerHTML = i + 1;
                    if (i === 0) {
                        select(container, btn);
                    }
                    container.append(btn);
                    btn.addEventListener("click", e => {
                        const index = [...container.childNodes].indexOf(btn);
                        select(container, btn);
                        populate(body, pages, index, length, wrap)
                    })
                });
            },
            download = (table, name, hide, head) => {
                const exporter = new CSV(table, head, hide);
                const csvOutput = exporter.convert();
                const csvBlob = new Blob([csvOutput], {
                    type: "text/csv"
                });
                const blobUrl = URL.createObjectURL(csvBlob);
                const anchorElement = document.createElement("a");

                anchorElement.href = blobUrl;
                anchorElement.download = name;
                anchorElement.click();
                anchorElement.remove();

                setTimeout(() => {
                    URL.revokeObjectURL(blobUrl);
                }, 500);
            };

        for (let i = 0; i < targets.length; i++) {
            const current = targets[i];
            const wrapper = document.createElement("div");
            const parent = current.parentElement;
            wrapper.innerHTML = /*html*/ `
                <div class="flex gap-4 justify-between">
                    <input type="search" placeholder="Search..." class="flex-1 w-0 lg:w-56 lg:flex-none appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block p-2 focus:outline-1 outline-primary" />
                    <div class="w-max flex flex-wrap gap-4 items-stretch">
                        <div class="w-24 relative">
                            <select class="w-full appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block p-2 focus:outline-1 outline-primary">
                                    <option value="10">10</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            <svg class="block w-5 h-5 text-gray-900 pointer-events-none absolute right-2 top-1/2 -translate-y-1/2" fill="currentcolor" viewBox="0 0 48 48">
                                    <path d="M24 31.8 10.9 18.7 14.2 15.45 24 25.35 33.85 15.5 37.1 18.75Z" />
                                </svg>
                        </div>
                        <button data-download class="w-[42px] h-[42px] flex items-center justify-center rounded-md text-white bg-green-400 outline-none hover:bg-green-300 focus:bg-green-300">
                            <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M23.95 30.35q-.45 0-.85-.2-.4-.2-.7-.5l-8-7.95q-.6-.65-.6-1.625t.7-1.675q.65-.6 1.575-.6.925 0 1.625.65l4 4.1V7q0-1 .675-1.675T24 4.65q1 0 1.625.675T26.25 7v15.55l4.1-4.1q.65-.65 1.6-.65.95 0 1.6.65.65.65.65 1.625t-.65 1.625l-7.95 7.95q-.3.3-.75.5t-.9.2ZM10.25 42.2q-1.8 0-3.175-1.35Q5.7 39.5 5.7 37.55V30.5q0-.95.675-1.625T8 28.2q1 0 1.625.675t.625 1.625v7.1H37.7v-7.1q0-.95.65-1.625t1.6-.675q1 0 1.65.675.65.675.65 1.625v7.1q0 1.9-1.4 3.25T37.7 42.2Z"/>  
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="w-full border border-gray-300 rounded-md my-4 overflow-hidden">
                    <div data-container class="overflow-auto max-h-[500px]">
                        <table class="w-max min-w-full text-md text-left text-gray-900">
                            <thead class="uppercase text-xs font-black border-b border-gray-300 sticky top-0" style="color: ${style.text};background: ${style.header};"></thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div data-pages class="w-full gap-2 flex justify-center flex-wrap lg:justify-end lg:ml-auto">
                </div>
            `;
            wrapper.className = "w-full overflow-auto";

            const pagination = wrapper.querySelector("[data-pages]");
            const container = wrapper.querySelector("[data-container]");
            const downloadbtn = wrapper.querySelector("[data-download]");
            const table = wrapper.querySelector("table");
            const select = wrapper.querySelector("select");
            const search = wrapper.querySelector("input");
            pagination.removeAttribute("data-pages");
            container.removeAttribute("data-container");
            downloadbtn.removeAttribute("data-download");

            const _hide = (current.getAttribute(hide) || "").split(",").map(e => parseInt(e));
            const _head = current.getAttribute(head) === "false" ? false : true;
            const _name = current.getAttribute(name) || "";

            downloadbtn.addEventListener("click", () => {
                console.log(current, _name, _hide, _head);
                download(current, _name, _hide, _head);
            })

            if (current.tHead) {
                const _ = document.createElement("tr");
                for (let td of current.querySelectorAll("thead tr td")) {
                    _.insertAdjacentHTML("beforeend", `
                        <td class="w-max px-4 py-2">${td.innerHTML}</td>
                    `);
                }
                table.tHead.appendChild(_);
            }

            for (let tr of current.querySelectorAll("tbody tr")) {
                const _ = document.createElement("tr");
                for (let td of tr.querySelectorAll("td")) {
                    _.insertAdjacentHTML("beforeend", `
                        <td class="px-4 py-2 max-w-[400px]">${td.innerHTML}</td>
                    `);
                }
                table.tBodies[0].appendChild(_);
            }


            const length = table.tHead.querySelectorAll("td").length,
                body = table.tBodies[0],
                rows = [...body.children];

            let items = [...body.children],
                pages = chunck(items),
                index = 0;

            select.addEventListener("change", e => {
                pages = chunck(items, parseInt(e.target.value));
                index = 0;
                populate(body, pages, index, length, container);
                buttons(pagination, pages, body, length, container);
            });
            search.addEventListener("input", e => {
                const filter = e.target.value.toUpperCase().trim();
                if (filter === "") {
                    items = rows;
                } else {
                    const __ = [];
                    rows.forEach(item => {
                        const phrase = item.innerText.toUpperCase().trim();
                        for (const niddle of filter.split(" ")) {
                            if (phrase.includes(niddle)) {
                                __.push(item);
                            }
                        }
                    });
                    items = __;
                }
                pages = chunck(items, parseInt(select.value));
                index = 0;
                populate(body, pages, index, length, container);
                buttons(pagination, pages, body, length, container);
            });

            if (rows.length > 50) select.selectedIndex = 1;
            if (rows.length > 100) select.selectedIndex = 2;

            pages = chunck(items, parseInt(select.value));
            populate(body, pages, index, length, container);
            buttons(pagination, pages, body, length, container);

            cleanInsert(parent, wrapper);
            current.removeAttribute(hide);
            current.removeAttribute(head);
            current.removeAttribute(name);
        }
        return this;
    },
    date(opts = {}) {
        const trigger = opts.trigger || "x-date",
            el = opts.el || null,
            style = {
                color: "#FFFFFF",
                background: theme.primary,
                current: theme.light,
                ...(opts.style || {})
            };

        var targets = document.querySelectorAll(`[${trigger}]`);
        if (el) targets = [...targets, ...(Array.isArray(el) ? el : [el])];
        if (!targets.length) return this;
        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", ];
        const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        const toggle = function(el) {
            classes.toggle(el.container, "hidden", "flex");
            classes.remove(el.container, "lg:top-full", "lg:bottom-full");
            var _ = ((window.innerHeight - el.container.getBoundingClientRect().top) < el.container.clientHeight) ? "lg:bottom-full" : "lg:top-full";
            classes.add(el.container, _);
            execute(el, el.current.date);
            el.current.dispatchEvent(new CustomEvent('toggle', {
                bubbles: true,
            }));
        };
        const execute = (el, date) => {
            el.list.innerHTML = "";
            var d = date === undefined ? null : date.getDate();
            var m = date === undefined ? null : date.getMonth();
            var y = date === undefined ? null : date.getFullYear();
            const _d = new Date(el.current.date);
            _d.setDate(1);

            var lastDay = new Date(_d.getFullYear(), _d.getMonth() + 1, 0).getDate();
            var firstDayIndex = _d.getDay();
            var lastDayIndex = new Date(_d.getFullYear(), _d.getMonth() + 1, 0).getDay();
            var nextDays = 7 - lastDayIndex - 1;

            el.head.innerHTML = months[_d.getMonth()] + ", " + _d.getFullYear();

            for (var i = firstDayIndex; i > 0; i--) {
                const item = document.createElement("li");
                item.className = "w-full";
                el.list.append(item);
            }

            for (var i = 1; i <= lastDay; i++) {
                var day = i < 10 ? "0" + i : i,
                    mon = el.current.date.getMonth() + 1 < 10 ? "0" + (el.current.date.getMonth() + 1) : el.current.date.getMonth() + 1,
                    _date = el.current.date.getFullYear() + "-" + mon + "-" + day,
                    item = document.createElement("li");
                item.className = "w-full h-8 flex items-center justify-center font-semibold rounded-md text-gray-900 text-sm hover:bg-gray-900 hover:text-gray-900 hover:bg-opacity-10 cursor-pointer";
                item.dataset.date = _date;
                item.dataset.day = days[(new Date(_date)).getDay()].toLowerCase();
                item.innerText = day;
                if (el.current.value === _date) {
                    item.style.backgroundColor = style.background;
                    item.style.color = style.color;
                } else if (i === new Date().getDate() && el.current.date.getMonth() === new Date().getMonth() && el.current.date.getFullYear() === new Date().getFullYear()) {
                    item.style.backgroundColor = style.current;
                }
                item.addEventListener("click", e => {
                    el.input.value = e.target.dataset.date;
                    el.current.value = e.target.dataset.date;
                    const date = el.current.value.split("-")
                    el.current.date.setFullYear(Number(date[0]))
                    el.current.date.setMonth(Number(date[1]) - 1)
                    el.current.date.setDate(Number(date[2]))
                    toggle(el);
                    el.current.dispatchEvent(new CustomEvent('select', {
                        bubbles: true,
                        detail: {
                            item: item,
                            date: e.target.dataset.date,
                        }
                    }));
                })
                el.list.append(item);
            }

            for (var i = 1; i <= nextDays; i++) {
                const item = document.createElement("li");
                item.className = "w-full";
                el.list.append(item);
            }
        }

        for (let i = 0; i < targets.length; i++) {
            const current = targets[i];
            current.date = new Date();
            classes.add(current, "hidden");
            current.setAttribute("readonly", true);
            const wrapper = document.createElement("div");
            classes.add(wrapper, "relative");
            wrapper.innerHTML = /*html*/ `
                <input readonly type="text" placeholder="${current.getAttribute("placeholder")||""}" class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full pr-10 p-2 focus:outline-1 outline-primary cursor-pointer"
                />
                <span class="flex w-5 h-5 items-center justify-center absolute right-2 top-1/2 -translate-y-1/2">
                    <svg class="block w-4 h-4 text-gray-900 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                        <path d="M24 28.25q-.9 0-1.575-.65-.675-.65-.675-1.6 0-.9.675-1.575.675-.675 1.625-.675.9 0 1.55.65t.65 1.6q0 .9-.65 1.575-.65.675-1.6.675Zm-8 0q-.9 0-1.575-.65-.675-.65-.675-1.6 0-.9.65-1.575.65-.675 1.6-.675.9 0 1.575.65.675.65.675 1.6 0 .9-.65 1.575-.65.675-1.6.675Zm15.95 0q-.85 0-1.525-.65-.675-.65-.675-1.6 0-.9.675-1.575.675-.675 1.575-.675.9 0 1.575.65.675.65.675 1.6 0 .9-.675 1.575-.675.675-1.625.675Zm-7.95 8q-.9 0-1.575-.675Q21.75 34.9 21.75 34q0-.9.675-1.575.675-.675 1.625-.675.9 0 1.55.675t.65 1.625q0 .85-.65 1.525-.65.675-1.6.675Zm-8 0q-.9 0-1.575-.675Q13.75 34.9 13.75 34q0-.9.65-1.575.65-.675 1.6-.675.9 0 1.575.675.675.675.675 1.625 0 .85-.65 1.525-.65.675-1.6.675Zm15.95 0q-.85 0-1.525-.675Q29.75 34.9 29.75 34q0-.9.675-1.575.675-.675 1.575-.675.9 0 1.575.675.675.675.675 1.625 0 .85-.675 1.525-.675.675-1.625.675ZM9.5 45.1q-1.85 0-3.2-1.375T4.95 40.55V10.5q0-1.9 1.35-3.25T9.5 5.9h2.95V4.8q0-.7.625-1.325t1.375-.625q.85 0 1.4.625.55.625.55 1.325v1.1h15.2V4.8q0-.7.575-1.325t1.375-.625q.85 0 1.425.625.575.625.575 1.325v1.1h2.95q1.9 0 3.25 1.35t1.35 3.25v30.05q0 1.8-1.35 3.175Q40.4 45.1 38.5 45.1Zm0-4.55h29V19.6h-29v20.95Z"/>
                    </svg>
                </span>
                <div class="fixed items-center justify-center p-4 inset-0 bg-gray-900 bg-opacity-40 z-20 lg:z-10 lg:absolute lg:top-full lg:inset-auto lg:p-0 lg:w-full lg:rounded-lg hidden">
                    <button class="block absolute top-2 right-4 text-white rounded-md focus:outline-1 focus:outline-1-2 outline-primary lg:hidden">
                        <svg class="block w-10 h-10 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                            <path
                                d="M12.45 37.65 10.35 35.55 21.9 24 10.35 12.45 12.45 10.35 24 21.9 35.55 10.35 37.65 12.45 26.1 24 37.65 35.55 35.55 37.65 24 26.1Z"
                            />
                        </svg>
                    </button>
                    <div class="w-full bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                        <div class="w-full overflow-auto flex flex-col gap-2 p-2">
                            <div class="w-full grid grid-rows-1 grid-cols-7 items-center mb-2">
                                <button class="w-full h-12 flex items-center justify-center text-gray-900 rounded-md outline-none hover:bg-gray-900 hover:text-gray-900 hover:bg-opacity-10 focus:bg-gray-900 focus:text-gray-900 focus:bg-opacity-10 cursor-pointer">
                                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                        <path d="M21.15 45.05.1 24 21.15 2.95l3.9 3.95L7.95 24l17.1 17.1Z"/>
                                    </svg>
                                </button>
                                <h1 class="flex-1 text-xl font-black text-gray-900 text-center col-span-5 px-2">
                                    Home
                                </h1>
                                <button class="w-full h-12 flex items-center justify-center text-gray-900 rounded-md outline-none hover:bg-gray-900 hover:text-gray-900 hover:bg-opacity-10 focus:bg-gray-900 focus:text-gray-900 focus:bg-opacity-10 cursor-pointer">
                                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                        <path d="M15.25 44.95 11.3 41l17.1-17.1L11.3 6.8l3.95-3.95 21 21.05Z"/>
                                    </svg>
                                </button>
                            </div>
                            <ul class="w-full grid grid-rows-1 grid-cols-7">
                                <li class="w-full flex items-center justify-center font-black rounded-md text-gray-900 text-sm">Sun</li>
                                <li class="w-full flex items-center justify-center font-black rounded-md text-gray-900 text-sm">Mon</li>
                                <li class="w-full flex items-center justify-center font-black rounded-md text-gray-900 text-sm">Tue</li>
                                <li class="w-full flex items-center justify-center font-black rounded-md text-gray-900 text-sm">Wen</li>
                                <li class="w-full flex items-center justify-center font-black rounded-md text-gray-900 text-sm">Thu</li>
                                <li class="w-full flex items-center justify-center font-black rounded-md text-gray-900 text-sm">Fri</li>
                                <li class="w-full flex items-center justify-center font-black rounded-md text-gray-900 text-sm">Sat</li>
                            </ul>
                            <ul class="w-full grid grid-rows-1 grid-cols-7"></ul>
                        </div>
                    </div>
                </div>
            `;

            const input = wrapper.querySelector("input");
            const container = wrapper.querySelector("div");
            const head = wrapper.querySelector("h1");
            const buttons = wrapper.querySelectorAll("button");
            const list = wrapper.querySelectorAll("ul")[1];

            current.addEventListener("click", () => {
                input.click();
            })

            if (current.value) {
                input.value = (new Date(current.value)).toISOString().split('T')[0];
                current.value = (new Date(current.value)).toISOString().split('T')[0];
                current.date = new Date(current.value);
            }

            for (let el of[input, buttons[0]]) {
                el.addEventListener("click", (e) => {
                    e.preventDefault();
                    toggle({
                        container: container,
                        current: current,
                        input: input,
                        list: list,
                        head: head,
                    })
                });
            }

            const config = {
                childList: true,
                subtree: true
            };

            const observer = new MutationObserver(() => {
                execute({
                    container: container,
                    input: input,
                    current: current,
                    list: list,
                    head: head,
                })
            });

            execute({
                container: container,
                input: input,
                current: current,
                list: list,
                head: head,
            });

            buttons[1].addEventListener("click", e => {
                e.preventDefault();
                current.date.setMonth(current.date.getMonth() - 1);
                execute({
                    container: container,
                    input: input,
                    current: current,
                    list: list,
                    head: head,
                });
            })

            buttons[2].addEventListener("click", e => {
                e.preventDefault();
                current.date.setMonth(current.date.getMonth() + 1);
                execute({
                    container: container,
                    input: input,
                    current: current,
                    list: list,
                    head: head,
                });
            })

            observer.observe(current, config);
            current.insertAdjacentElement("afterend", wrapper);
            current.removeAttribute(trigger);
        }
        return this;
    },
    pie(el, opts = {}) {
        const donut = opts.donut || false,
            stroke = opts.stroke || 16,
            values = opts.values || {},
            colors = opts.colors || [],
            tooltip = opts.tooltip || false,
            callback = opts.callback || (() => {});

        el.innerHTML = "<h2 class='w-full text-center p-4 text-2xl font-black'>Loading...</h2>";
        var angleOffset = -90,
            chartData = [],
            cx = 60,
            cy = 60,
            radius = cx - (stroke / 2),
            strokeWidth = donut ? stroke : 100,
            _data = Object.values(values),
            keys = Object.keys(values);

        function adjustedCircumference() {
            return circumference() - 2
        }

        function circumference() {
            return 2 * Math.PI * radius
        }

        function dataTotal() {
            return _data.reduce((acc, val) => acc + val)
        }

        function calculateChartData() {
            _data.forEach((dataVal) => {
                chartData.push(angleOffset)
                angleOffset = dataPercentage(dataVal) * 360 + angleOffset
            })
        }

        function calculateStrokeDashOffset(dataVal, circumference) {
            const strokeDiff = dataPercentage(dataVal) * circumference
            return circumference - strokeDiff
        }

        function dataPercentage(dataVal) {
            return dataVal / dataTotal()
        }

        function percentageString(dataVal) {
            return `${((dataPercentage(dataVal)||0) * 100).toFixed(2)}%`
        }

        function returnCircleTransformValue(index) {
            return `rotate(${chartData[index]}, ${cx}, ${cy})`
        }

        calculateChartData();
        const svg = makeNode("svg", {
            style: "border-radius: 50%; overflow: hidden"
        });

        svg.setAttribute("viewBox", `0 0 ${cx * 2} ${cy * 2}`);

        for (let i = 0; i < _data.length; i++) {
            const current = _data[i];
            svg.append(makeNode("circle", {
                cx: cx,
                cy: cy,
                r: radius,
                stroke: colors[i],
                "stroke-width": strokeWidth,
                "stroke-dasharray": adjustedCircumference(),
                "stroke-dashoffset": calculateStrokeDashOffset(current, circumference()),
                fill: "transparent",
                transform: returnCircleTransformValue(i)
            }));
        }

        cleanInsert(el, svg);
        if (tooltip) {
            var cols = "";
            for (let i = 0; i < keys.length; i++) {
                const current = keys[i];
                const value = _data[i];
                cols += `
                <div style="display: flex;gap: .5rem; align-items: center">
                    <span style="width: 3rem; height: 2rem;background: ${colors[i]}"></span>
                    <span style="font-size: 1.2rem">${value} ${current}</span>
                </div>
            `
            }
            el.innerHTML += `
                <div style="width: max-content;margin: .5rem auto 0 auto;">
                    ${cols}
                </div>
            `
        }
        callback({
            el: el,
            svg: svg,
            values: values,
            colors: colors,
            percentageString: percentageString
        })
        return this;
    },
    chart(el, opts = {}) {
        const values = opts.values || {},
            type = opts.type || "line",
            tooltip = opts.tooltip || false,
            font = opts.font || 8,
            width = opts.width || 500,
            height = opts.height || 300,
            write = opts.write || false,
            callback = opts.callback || (() => {}),
            colors = {
                label: "#111827",
                grid: "#f3f4f6",
                chart: theme.primary,
                tooltip: "#EF4444",
                ...(opts.colors || {})
            };

        el.innerHTML = "<h2 class='w-full text-center p-4 text-2xl font-black'>Loading...</h2>";
        let w = width,
            h = height,
            x_space = 20,
            _data = Object.values(values),
            keys = Object.keys(values),
            max = Math.max(..._data),
            min = Math.min(..._data);

        const num = n => {
            fix = n => {
                n = Number.isInteger(Number(n)) ? Number(n) : Number(n).toFixed(1);
                return String(n).split(".")[1] === "0" ? String(n).split(".")[0] : n
            }

            return n < 1000 ? fix(n) : n < 100000 ? fix(n / 1000) + "k" : fix(n / 1000000) + "M";
        }

        if (num(max).length < 1) x_space = 10
        else if (num(max).length < 2) x_space = 15
        else if (num(max).length < 3) x_space = 20
        else if (num(max).length < 4) x_space = 25
        else if (num(max).length < 5) x_space = 30
        else if (num(max).length < 6) x_space = 35
        else if (num(max).length < 7) x_space = 40

        let step = Math.round(((max - min) / _data.length)),
            row = (h - 30) / (_data.length + 1.5),
            column = ((w - (x_space - 40)) / _data.length) - 3,
            text = min,
            y = 40,
            x = x_space + 10,
            x2 = x_space + 10,
            x3 = x_space + 10,
            x4 = x_space + 10,
            x5 = x_space + 10,
            x6 = x_space + 10,
            points = "",
            svg = makeNode("svg"),
            grid = makeNode("g"),
            labels = makeNode("g"),
            dots = makeNode("g"),
            line = makeNode("g"),
            area = makeNode("g"),
            bars = makeNode("g"),
            tips = makeNode("g");

        draw(svg)
            .viewBox(`0 0 ${w} ${h}`); //.append("g").attr("transform", "translate(0 0)");

        //axes
        draw(grid)
            .append("line")
            .x1(x_space)
            .y1(1)
            .x2(x_space)
            .y2(h - 30)
            .stroke(colors.label)
            .exit()
            .append("line")
            .x1(x_space)
            .y1(h - 30)
            .x2(w - 0)
            .y2(h - 30)
            .stroke(colors.label)

        //rows labels and grid
        while (text < (max + step)) {
            draw(labels)
                .append("text")
                .x(5)
                .y((h - y) - 4)
                .text(num(text))
                .fill(colors.label)
                .attr("font-weight", "bold")
                .attr("font-size", font)
            draw(grid)
                .append("line")
                .x1(x_space)
                .y1((h - y) - 6)
                .x2(w)
                .y2((h - y) - 6)
                .stroke(colors.grid)
            y += row
            text += step
        }

        //colums labels
        for (let n in keys) {
            const t = draw(labels)
                .append("text")
                .x(x + 10)
                .y(h - 15)
                .text(keys[n])
                .fill(colors.label)
                .attr("font-weight", "bold")
                .attr("font-size", font)
                .attr("text-anchor", "middle");
            if (write) t.attr("writing-mode", "tb");
            x += column
        }

        //colums grid
        for (let v in _data) {
            draw(grid)
                .append("line")
                .x1(x6 + 10)
                .y1((h - y) - 2)
                .x2(x6 + 10)
                .y2(h - 30)
                .stroke(colors.grid);
            x6 += column
        }

        svg.appendChild(grid)
        svg.appendChild(labels)

        //path _data
        for (let v in _data) {
            let y3 = 40,
                data = min;
            while (data < _data[v]) {
                y3 += 1
                data += (step / row)
            }
            points += `${x2+10},${h-(y3+6)} `
            x2 += column
        }

        //line
        if (type.toLowerCase().includes("line")) {
            draw(line)
                .append("polyline")
                .points(points)
                .fill("none")
                .stroke(colors.chart)
                .strokeWidth(3);
            svg.appendChild(line)
        }

        //area
        if (type.toLowerCase().includes("area")) {
            draw(area)
                .append("polyline")
                .points(`${x_space},${h - 30} ` + points + `${w},${h - 30}`)
                .fill(colors.chart + 60)
                .strokeWidth(1.5);
            svg.appendChild(area)
        }


        //bars
        if (type.toLowerCase().includes("bars")) {
            for (let v in _data) {
                let y3 = 40,
                    data = min;
                while (data < _data[v]) {
                    y3 += 1
                    data += (step / row)
                }
                var c = draw(bars)
                    .append("line")
                    .x1(x3 + 10)
                    .y1(h - (y3 + 6))
                    .x2(x3 + 10)
                    .y2(h - 30)
                    .stroke(colors.chart)
                    .strokeWidth(column - 4);
                x3 += column
            }
            svg.appendChild(bars)
        }

        //dots
        if (type.toLowerCase().includes("dots")) {
            for (let v in _data) {
                let y4 = 40,
                    data = min;
                while (data < _data[v]) {
                    y4 += 1
                    data += (step / row)
                }
                var c = draw(dots)
                    .append("circle")
                    .cx(x4 + 10)
                    .cy(h - (y4 + 6))
                    .r(5)
                    .fill(colors.chart)
                x4 += column
            }
            svg.appendChild(dots)
        }

        //tooltip
        if (tooltip) {
            for (let v in _data) {
                let y5 = 40,
                    data = min;
                while (data < _data[v]) {
                    y5 += 1
                    data += (step / row)
                }

                var space = 10;

                draw(tips)
                    .append("line")
                    .x1(x5 + 10)
                    .y1((h - y) - 2)
                    .x2(x5 + 10)
                    .y2(h - 30)
                    .stroke("transparent")
                    .strokeWidth(column)
                    .attr("data-value", num(_data[v]))
                    .hover(hover)
                    .exit()
                    .append("text")
                    .x(x5 + 10)
                    .y(h - (y5 + space) > 20 ? h - (y5 + space) : h - (y5 - space))
                    .attr("text-anchor", "middle")
                    .attr("font-weight", "bold")
                    .attr("font-size", 14)
                    .fill(colors.tooltip);
                x5 += column
            }
            svg.appendChild(tips)

            function hover(e) {
                const val = e.target.dataset.value;
                e.target.nextSibling.innerHTML = val;
                e.target.onpointerout = () => {
                    e.target.nextSibling.innerHTML = "";
                }
            }
        }

        cleanInsert(el, svg);
        callback({
            el: el,
            svg: svg,
            values: values,
            colors: colors,
        })
        return this;
    }
}

class Toaster {
    constructor(opts = {}) {
        const positionX = opts.positionX || "right";
        const positionY = opts.positionY || "top";
        const classes = [];
        if (positionX === "right") classes.push("right-0")
        if (positionX === "left") classes.push("left-0")
        if (positionX === "center") classes.push("left-1/2", "-translate-x-1/2");

        if (positionY === "top") classes.push("top-0")
        if (positionY === "bottom") classes.push("bottom-0")
        if (positionY === "center") classes.push("top-1/2", "-translate-y-1/2");

        this.timer = opts.timer || 5000;
        this.width = opts.width || 400;
        this.container = document.createElement("section");
        this.container.className = "fixed z-20 max-w-full flex flex-col-reverse gap-4 p-4 overflow-hidden " + classes.join(" ");
        this.container.style.width = this.width + "px";
        document.body.insertAdjacentElement("afterbegin", this.container)
    }

    toast(message, color) {
        const div = document.createElement("div");
        div.className = `relative w-full opacity-0 duration-500 opacity-0 rounded-md border border-${color}-500 bg-${color}-300 p-2 pr-8 text-lg shadow-md`;
        div.innerHTML = message + `
            <button class="block absolute top-2 right-2 text-${color}-500 rounded-md focus:outline-1 focus:outline-1-2 outline-primary">
                <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                    <path
                        d="M12.45 37.65 10.35 35.55 21.9 24 10.35 12.45 12.45 10.35 24 21.9 35.55 10.35 37.65 12.45 26.1 24 37.65 35.55 35.55 37.65 24 26.1Z"
                    />
                </svg>
            </button>
        `;
        div.querySelector("button").addEventListener("click", () => div.remove());
        this.container.appendChild(div);
        setTimeout(() => {
            classes.remove(div, "opacity-0");
            setTimeout(() => {
                div.remove();
            }, this.timer);
        }, 10);
        return this;
    }

    success(message) {
        return this.toast(message, "green");
    }

    warning(message) {
        return this.toast(message, "yellow");
    }

    info(message) {
        return this.toast(message, "blue");
    }

    error(message) {
        return this.toast(message, "red");
    }
}

function change() {
    const _ = document.querySelector("#type");
    ['employee', 'client'].forEach(element => {
        const current = document.querySelector(`[x-${element}]`);
        const select = current.querySelector("select");
        if (_.value === element) {
            classes.remove(current, 'hidden')
            select.removeAttribute("disabled");
        } else {
            classes.add(current, 'hidden');
            select.setAttribute("disabled", true);
        }
    });
}

function queries() {
    var params = new URLSearchParams(location.search);
    var obj = {};
    new Set([...params.keys()]).forEach((key) => {
        obj[key] = params.getAll(key).length > 1 ? params.getAll(key) : params.get(key);
    });
    return obj;
}

function kanban(status) {
    const wraps = document.querySelectorAll("[x-wrap]");
    const items = document.querySelectorAll("[x-item]");
    [...wraps].forEach(wrap => {
        wrap.addEventListener("dragover", (e) => {
            e.preventDefault()
        });
        wrap.addEventListener("drop", (e) => {
            e.preventDefault();
            var data = e.dataTransfer.getData("text");
            var item = e.target.closest('[x-item]');
            var _new = document.querySelector(`[x-item="${data}"]`);
            if (item) e.currentTarget.insertBefore(_new, item);
            else e.currentTarget.appendChild(_new);
            status(data, e.currentTarget.getAttribute('x-wrap'));
        });
    });
    [...items].forEach(item => {
        item.addEventListener("dragstart", (e) => {
            e.dataTransfer.setData("text", e.target.getAttribute("x-item"));
        });
    });
}

function upload(e) {
    for (const file of e.files) {
        DATA.items.add(file);
        e.parentElement.nextElementSibling.insertAdjacentHTML('afterbegin', `
            <div class="flex flex-wrap gap-2 items-center justify-between p-2 border-t border-gray-300">
                <span class="relative">
                    <input data-file type="checkbox" onchange="remove(event)" class="w-5 h-5 accent-primary cursor-pointer peer opacity-0 absolute inset-0" />
                    <svg class="block w-5 h-5 pointer-events-none text-red-400" fill="currentcolor" viewBox="0 0 48 48">
                        <path
                            d="M12.65 43.05q-1.8 0-3.2-1.35-1.4-1.35-1.4-3.2V10.9H7.5q-.95 0-1.575-.65T5.3 8.65q0-1 .625-1.65.625-.65 1.575-.65h9.1q0-1 .65-1.675T18.9 4h10.2q1 0 1.675.675t.675 1.675h9q1 0 1.65.675.65.675.65 1.575 0 1.05-.65 1.675t-1.65.625h-.55v27.6q0 1.85-1.35 3.2t-3.25 1.35Zm5.2-10.25q0 .7.55 1.25t1.25.55q.75 0 1.325-.55t.575-1.25V16.6q0-.75-.6-1.325t-1.3-.575q-.75 0-1.275.575-.525.575-.525 1.325Zm8.65 0q0 .7.575 1.25t1.275.55q.75 0 1.325-.55t.575-1.25V16.6q0-.75-.575-1.325T28.35 14.7q-.75 0-1.3.575T26.5 16.6Z" />
                    </svg>
                </span>
                <a class="block flex-1 text-md truncate text-ellipsis overflow-hidden peer peer-checked:line-through hover:underline">
                    ${file.name}
                </a>
            </div>
        `);
    }
    e.files = DATA.files;
    rename();
}

function remove(e) {
    const files = [...document.querySelectorAll("[data-file]")];
    const index = files.indexOf(e.target);
    DATA.items.remove(index);
    e.target.parentElement.parentElement.remove();
    document.querySelector('#document').files = DATA.files;
    rename();
}

function rename() {
    document.querySelector("#text-display").value = (!DATA.files.length) ?
        "" : DATA.files.length + " Files selected";
}