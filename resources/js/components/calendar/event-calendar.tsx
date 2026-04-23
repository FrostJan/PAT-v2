import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import FullCalendar from '@fullcalendar/react';
import timeGridPlugin from '@fullcalendar/timegrid';
import { router } from '@inertiajs/react';
import { useCallback, useEffect, useState } from 'react';

import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Button } from '@/components/ui/button';

interface CalendarEvent {
    event_id: number;
    request_id: number;
    user_id: number;
    title: string;
    start: string;
    end: string;
    color: string;
    allDay?: boolean;
}

export function EventCalendar() {
    const [events, setEvents] = useState<CalendarEvent[]>([]);
    const [selected, setSelected] = useState<CalendarEvent | null>(null);

    useEffect(() => {
        fetch('/calendar/events', { headers: { Accept: 'application/json' } })
            .then((res) => res.json())
            .then((body) => setEvents(body.data ?? []))
            .catch(() => setEvents([]));
    }, []);

    const handleEventClick = useCallback((clickInfo: { event: { extendedProps: CalendarEvent } }) => {
        setSelected(clickInfo.event.extendedProps);
    }, []);

    return (
        <>
            <div className="rounded-xl border bg-background p-4">
                <FullCalendar
                    plugins={[dayGridPlugin, timeGridPlugin, interactionPlugin]}
                    initialView="dayGridMonth"
                    headerToolbar={{
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay',
                    }}
                    events={events.map((e) => ({
                        id: String(e.event_id),
                        title: e.title,
                        start: e.start,
                        end: e.end,
                        color: e.color,
                        allDay: e.allDay,
                        extendedProps: e,
                    }))}
                    eventClick={handleEventClick}
                    height="auto"
                />
            </div>

            <Dialog open={selected !== null} onOpenChange={(open) => !open && setSelected(null)}>
                <DialogContent>
                    <DialogHeader>
                        <DialogTitle>{selected?.title}</DialogTitle>
                        <DialogDescription>
                            {selected ? `${selected.start}${selected.end ? ' — ' + selected.end : ''}` : ''}
                        </DialogDescription>
                    </DialogHeader>
                    <DialogFooter>
                        <Button
                            onClick={() => {
                                if (selected) {
                                    router.visit(`/requests/${selected.request_id}`);
                                }
                            }}
                        >
                            See details
                        </Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        </>
    );
}
