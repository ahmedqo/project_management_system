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
    toggle(opts = {}) {
        const trigger = opts.trigger || "x-toggle",
            property = opts.property || "x-property";

        const triggers = document.querySelectorAll(`[${trigger}]`);
        if (!triggers.length) return this;

        for (let i = 0; i < triggers.length; i++) {
            const map = {
                property: triggers[i].getAttribute(property).split(",") || [],
                trigger: triggers[i],
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
    select(opts = {}) {
        const trigger = opts.trigger || "x-select",
            el = opts.el || null,
            style = {
                color: "#FFFFFF",
                background: "#60A5FA",
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
            el.current.selectedIndex = i;
            el.input.value = el.target.innerText;
            for (let item of el.list.children) {
                item.removeAttribute("style")
            }
            el.target.style.backgroundColor = style.background;
            el.target.style.color = style.color;
        }
        const execute = (el) => {
            const options = Array.from(el.current.querySelectorAll(":scope > option")).map(op => {
                op.padd = "";
                return op;
            });
            const groups = el.current.querySelectorAll("optgroup");
            if (groups.length) {
                for (let group of groups) {
                    options.push({
                        text: group.label,
                        head: true
                    }, ...Array.from(group.querySelectorAll("option")).map(op => {
                        op.padd = "px-4 ";
                        return op;
                    }))
                }
            }
            if (options.length < 10) {
                el.search.remove();
            }
            for (let i = 0; i < options.length; i++) {
                const option = options[i];
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
                        }, i);
                    }
                    if (option.hasAttribute("disabled")) {
                        item.className += " bg-gray-400";
                    } else {
                        item.className += " hover:bg-gray-900 hover:text-gray-900 hover:bg-opacity-10 cursor-pointer";
                        item.addEventListener("click", e => {
                            select({
                                list: el.list,
                                current: el.current,
                                input: el.input,
                                target: item,
                            }, i);
                            toggle({
                                container: el.container,
                                current: el.current,
                                search: el.search,
                                list: el.list
                            });
                            el.current.dispatchEvent(new CustomEvent('select', {
                                bubbles: true,
                                detail: {
                                    item: item,
                                    index: i,
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
                    input: el.input,
                    search: el.search,
                }
            }))
        }

        for (let i = 0; i < targets.length; i++) {
            const current = targets[i];
            classes.add(current, "hidden");
            const wrapper = document.createElement("div");
            classes.add(wrapper, "relative");
            wrapper.innerHTML = /*html*/ `
                <input readonly type="text" placeholder="${current.getAttribute("placeholder")||""}" class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full pr-10 p-2 focus:outline-1 outline-blue-400 cursor-pointer shadow-sm"
                />
                <svg class="block w-6 h-6 text-gray-900 pointer-events-none absolute right-2 top-1/2 -translate-y-1/2" fill="currentcolor" viewBox="0 0 48 48">
                    <path d="M24 31.8 10.9 18.7 14.2 15.45 24 25.35 33.85 15.5 37.1 18.75Z" />
                </svg>
                <div class="fixed items-center justify-center p-4 inset-0 bg-gray-900 bg-opacity-40 z-20 lg:z-10 lg:absolute lg:top-full lg:inset-auto lg:p-0 lg:w-full lg:rounded-lg hidden">
                    <button class="block absolute top-2 right-4 text-white rounded-md focus:outline-1 focus:outline-1-2 outline-blue-400 lg:hidden">
                        <svg class="block w-10 h-10 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                            <path
                                d="M12.45 37.65 10.35 35.55 21.9 24 10.35 12.45 12.45 10.35 24 21.9 35.55 10.35 37.65 12.45 26.1 24 37.65 35.55 35.55 37.65 24 26.1Z"
                            />
                        </svg>
                    </button>
                    <div class="w-full bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                        <div class="w-full overflow-auto max-h-100 lg:max-h-60">
                            <input id="search" type="text" placeholder="Search" class="appearance-none sticky top-0 bg-white border-b border-gray-300 text-gray-900 text-md block w-full p-2 outline-none" />
                            <ul class="w-full">
                            </ul>
                        </div>
                    </div>
                </div>
            `;
            const selected = current.querySelector("option[selected]") ? "" : "selected"
            current.insertAdjacentHTML("afterbegin", "<option disabled " + selected + "></option>");
            const inputs = wrapper.querySelectorAll("input");
            const container = wrapper.querySelector("div");
            const button = wrapper.querySelector("button");
            const list = wrapper.querySelector("ul");

            current.addEventListener("click", () => {
                inputs[0].click();
            })

            inputs[1].addEventListener("input", e => {
                const filter = e.target.value.toUpperCase();
                for (let item of wrapper.querySelectorAll("li:not(.header)")) {
                    const txt = item.textContent || item.innerText;
                    if (txt && txt.toUpperCase().indexOf(filter) > -1) {
                        classes.remove(item, "hidden");
                    } else {
                        classes.add(item, "hidden");
                    }
                }
            });

            for (let el of[inputs[0], button]) {
                el.addEventListener("click", (e) => {
                    e.preventDefault();
                    toggle({
                        container: container,
                        current: current,
                        search: inputs[1],
                        list: list,
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
                    search: inputs[1],
                    input: inputs[0],
                    current: current,
                    list: list,
                })
            });

            execute({
                container: container,
                search: inputs[1],
                input: inputs[0],
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
            el = opts.el || null,
            style = {
                color: "#FFFFFF",
                background: "#60A5FA",
                header: "#60A5FA",
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
                    body.innerHTML = "<tr><td class='py-4 text-center' colspan='" + len + "'>NO DATA FOUND</td></tr>"
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
                    btn.className = "w-8 h-8 appearance-none text-sm flex items-center justify-center rounded-md font-black bg-gray-100 text-gray-900 hover:bg-gray-900 outline-none hover:text-gray-900 hover:bg-opacity-10 focus:bg-gray-900 focus:text-gray-900 focus:bg-opacity-10 cursor-pointer shadow-sm border border-gray-300";
                    btn.innerHTML = i + 1;
                    if (i === 0) {
                        select(container, btn);
                    }
                    container.append(btn);
                    btn.addEventListener("click", e => {
                        const index = Array.from(container.childNodes).indexOf(btn);
                        select(container, btn);
                        populate(body, pages, index, length, wrap)
                    })
                });
            };

        for (let i = 0; i < targets.length; i++) {
            const current = targets[i];
            const wrapper = document.createElement("div");
            const parent = current.parentElement;
            wrapper.innerHTML = /*html*/ `
                <div class="flex gap-4 justify-between">
                    <input id="username" type="search" placeholder="Search..." class="w-full lg:w-56 appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block p-2 focus:outline-1 outline-blue-400 shadow-sm" />
                    <div class="w-24 relative">
                        <select class="w-full appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block p-2 focus:outline-1 outline-blue-400 shadow-sm">
                                <option value="10">10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        <svg class="block w-6 h-6 text-gray-900 pointer-events-none absolute right-2 top-1/2 -translate-y-1/2" fill="currentcolor" viewBox="0 0 48 48">
                                <path d="M24 31.8 10.9 18.7 14.2 15.45 24 25.35 33.85 15.5 37.1 18.75Z" />
                            </svg>
                    </div>
                </div>
                <div class="w-full border border-gray-300 rounded-md my-4 overflow-hidden shadow-sm">
                    <div data-table class="overflow-auto max-h-[500px]"></div>
                </div>
                <div data-pages class="w-full gap-2 flex justify-center flex-wrap lg:justify-end lg:ml-auto">
                </div>
            `;
            wrapper.className = "w-full overflow-auto";

            const pagination = wrapper.querySelector("[data-pages]");
            const container = wrapper.querySelector("[data-table]");
            const select = wrapper.querySelector("select");
            const search = wrapper.querySelector("input");
            pagination.removeAttribute("data-pages");
            container.removeAttribute("data-table");

            current.className = "w-full text-md text-left text-gray-900";
            current.tHead.className = "uppercase font-black border-b border-gray-300 sticky top-0";
            current.tHead.style = `color: ${style.text};background: ${style.header};`;

            container.appendChild(current);

            for (let tr of current.querySelectorAll("thead tr td"))
                tr.className = "min-w-max px-4 py-2";

            for (let tr of current.querySelectorAll("tbody tr td"))
                tr.className = "px-4 py-2";


            var length = current.querySelectorAll("td").length,
                body = current.querySelector("tbody"),
                rows = Array.from(body.children),
                items = Array.from(body.children),
                pages = chunck(items),
                index = 0;

            select.addEventListener("change", e => {
                pages = chunck(items, parseInt(e.target.value));
                index = 0;
                populate(body, pages, index, length, container);
                buttons(pagination, pages, body, length, container);
            });

            search.addEventListener("input", e => {
                const filter = e.target.value.toUpperCase();
                if (filter.trim() === "") {
                    items = rows;
                } else {
                    const __ = [];
                    rows.forEach(item => {
                        td = item.innerText;
                        if (td && td.toUpperCase().indexOf(filter) > -1) {
                            __.push(item);
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
            current.removeAttribute(trigger);
        }
        return this;
    },
    date(opts = {}) {
        const trigger = opts.trigger || "x-date",
            el = opts.el || null,
            style = {
                color: "#FFFFFF",
                background: "#60A5FA",
                current: "#93C5FD",
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
            current.setAttribute("disabled", true);
            const wrapper = document.createElement("div");
            classes.add(wrapper, "relative");
            wrapper.innerHTML = /*html*/ `
                <input readonly type="text" placeholder="${current.getAttribute("placeholder")||""}" class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full pr-10 p-2 focus:outline-1 outline-blue-400 cursor-pointer shadow-sm"
                />
                <svg class="block w-6 h-6 text-gray-900 pointer-events-none absolute right-2 top-1/2 -translate-y-1/2" fill="currentcolor" viewBox="0 0 48 48">
                    <path d="M24 31.8 10.9 18.7 14.2 15.45 24 25.35 33.85 15.5 37.1 18.75Z" />
                </svg>
                <div class="fixed items-center justify-center p-4 inset-0 bg-gray-900 bg-opacity-40 z-20 lg:z-10 lg:absolute lg:top-full lg:inset-auto lg:p-0 lg:w-full lg:rounded-lg hidden">
                    <button class="block absolute top-2 right-4 text-white rounded-md focus:outline-1 focus:outline-1-2 outline-blue-400 lg:hidden">
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
                                    <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                        <path d="M21.15 45.05.1 24 21.15 2.95l3.9 3.95L7.95 24l17.1 17.1Z"/>
                                    </svg>
                                </button>
                                <h1 class="flex-1 text-xl font-black text-gray-900 text-center col-span-5 px-2">
                                    Home
                                </h1>
                                <button class="w-full h-12 flex items-center justify-center text-gray-900 rounded-md outline-none hover:bg-gray-900 hover:text-gray-900 hover:bg-opacity-10 focus:bg-gray-900 focus:text-gray-900 focus:bg-opacity-10 cursor-pointer">
                                    <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
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
                console.log(100)
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
            return `${(dataPercentage(dataVal) * 100).toFixed(2)}%`
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
                chart: "#60A5FA",
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
        this.container = document.createElement("section");
        this.container.className = "absolute z-20 w-full lg:w-96 flex flex-col-reverse gap-4 p-4 overflow-hidden " + classes.join(" ");
        document.body.insertAdjacentElement("afterbegin", this.container)
    }

    toast(message, color) {
        const div = document.createElement("div");
        div.className = `relative w-full opacity-0 duration-500 opacity-0 rounded-md border border-${color}-500 bg-${color}-300 p-2 pr-8 text-lg shadow-md`;
        div.innerHTML = message + `
            <button class="block absolute top-2 right-2 text-${color}-500 rounded-md focus:outline-1 focus:outline-1-2 outline-blue-400">
                <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
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