import { Listbox, Transition } from "@headlessui/react";
import { Fragment } from "react";

export default function ComboBox({ handler, items, label }) {
    return (
        <Listbox onChange={handler}>
            <div className="relative mt-1 w-60">
                <Listbox.Button className="relative text-white w-full cursor-default rounded-sm bg-red-500 py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm">
                    <span className="block truncate font-bold">{label}</span>
                    <span className="pointer-events-none absolute inset-y-0 text-2xl right-0 flex items-center pr-2">
                        -
                    </span>
                </Listbox.Button>
                <Transition
                    as={Fragment}
                    leave="transition ease-in duration-100"
                    leaveFrom="opacity-100"
                    leaveTo="opacity-0"
                >
                    <Listbox.Options className="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm">
                        {items.map((product, i) => (
                            <Listbox.Option
                                key={i}
                                className={({ active }) =>
                                    `relative cursor-default select-none py-2 px-4 ${active
                                        ? "bg-amber-100 text-amber-900"
                                        : "text-gray-900"
                                    }`
                                }
                                value={product}
                            >
                                {({ selected }) => (
                                    <span
                                        className={`block truncate ${selected ? "font-medium" : "font-normal"}`}
                                    >
                                        {product.name}
                                    </span>
                                )}
                            </Listbox.Option>
                        ))}
                    </Listbox.Options>
                </Transition>
            </div>
        </Listbox>
    );
}
