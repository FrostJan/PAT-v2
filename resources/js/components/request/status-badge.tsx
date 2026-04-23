import { Badge } from '@/components/ui/badge';
import { type RequestStatus } from '@/types';

export function StatusBadge({ status }: { status: RequestStatus }) {
    const map: Record<RequestStatus, { label: string; className: string }> = {
        pending: { label: 'Pending', className: 'bg-yellow-500 text-white hover:bg-yellow-500' },
        approved: { label: 'Approved', className: 'bg-green-600 text-white hover:bg-green-600' },
        declined: { label: 'Declined', className: 'bg-red-600 text-white hover:bg-red-600' },
    };
    const s = map[status] ?? map.pending;
    return <Badge className={s.className}>{s.label}</Badge>;
}
