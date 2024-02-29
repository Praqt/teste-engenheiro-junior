export const StatusEnum = [
    {
        label: "Em Aberto",
        value: "open",
    },
    {
        label: "Pago",
        value: "paid",
    },
    {
        label: "Cancelado",
        value: "cancelled",
    },
];

export function normalizeStatus(statusValue) {
    return StatusEnum.find((status) => status.value == statusValue).label;
}
