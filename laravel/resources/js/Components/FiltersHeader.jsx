import { ChevronDownIcon } from "@heroicons/react/24/solid";
import { Disclosure } from "@headlessui/react";

export default function FiltersHeader({ fields, handleFilterSubmit }) {
    return (
        <Disclosure>
            {({ open }) => (
                <>
                    <Disclosure.Button className="w-fit text-gray-500 hover:text-gray-200 hover:border-b border-gray-700">
                        <div className="flex items-center">
                            <span>Filtragem</span>
                            <ChevronDownIcon
                                className={`${open ? "rotate-180 transform" : ""
                                    } h-5 w-5 transition-transform`}
                            />
                        </div>
                    </Disclosure.Button>
                    <Disclosure.Panel className="px-4 text-gray-200">
                        <form
                            className="grid grid-cols-3"
                            onSubmit={handleFilterSubmit}
                        >
                            <div className="p-4 border-l-2 border-blue-800 w-fit h-fit">
                                <h6 className="text-xl mb-3 text-gray-300">
                                    Ordernar por...
                                </h6>
                                <ul className="flex gap-y-2 flex-col">
                                    {fields.map((field, i) => (
                                        <li key={i}>
                                            <label className="flex items-center gap-x-1">
                                                <input
                                                    type="radio"
                                                    name="orderBy"
                                                    value={field.value}
                                                    className="form-radio"
                                                />
                                                <span>{field.label}</span>
                                            </label>
                                        </li>
                                    ))}
                                </ul>
                            </div>
                            <div className="pb-4 pr-4 justify-self-end flex flex-col text-gray-800 border-blue-800 border-r-2 col-span-2 w-fit">
                                <h6 className="text-xl text-gray-300 mb-1">
                                    Filtrar por semelhança...
                                </h6>
                                {fields.map((field, i) => (
                                    <input
                                        key={i}
                                        type="text"
                                        placeholder={field.label}
                                        name={field.value}
                                        className="rounded-md my-1"
                                    />
                                ))}
                            </div>

                            <button
                                type="submit"
                                className="col-span-full hover:scale-105 transition-transform mx-auto w-fit py-2 px-5 bg-red-800 rounded-sm"
                            >
                                Filtrar
                            </button>
                        </form>
                    </Disclosure.Panel>
                </>
            )}
        </Disclosure>
    );
}
